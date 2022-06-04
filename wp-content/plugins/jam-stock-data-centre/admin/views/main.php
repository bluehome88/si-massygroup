<?php

include_once(get_home_path()."/wp-content/plugins/jam-stock-data-centre/lib/simplehtmldom/simple_html_dom.php");

function fetch_latest_stock_entry(){
  $html = file_get_html('https://www.stockex.co.tt/manage-stock/massy/');

  // get data block
  foreach($html->find('table#index_information') as $row) {
    $item['opening'] = trim($row->find('td', 1)->plaintext);
    $item['change'] = trim($row->find('td', 2)->plaintext);
    $item['change_per'] = trim($row->find('td', 3)->plaintext);
  }

  // get latest date
  foreach($html->find('div#elementor-tab-content-2321') as $content) {
    $date_para = trim($content->find('u', 0)->plaintext);
    $item['date'] = trim(str_replace('Trade Information for', '', $date_para));
  }

  $ret[] = $item;

  // clean up memory
  $html->clear();
  unset($html);

  return $ret;
}

function get_prev_stock_data(){
  global $wpdb;
  $stock_data = array();
  $html = '';
  $stock_data_table = $wpdb->prefix . "jam_stock_data";

  $stock_data_results = $wpdb->get_results("SELECT jsdt.timestamp,jsdt.value,jsdt.change_value,jsdt.change_percentage 
    FROM $stock_data_table AS jsdt
    ORDER BY jsdt.id DESC
    LIMIT 2");

  /* Group Income Statement Information data by year */
  foreach ($stock_data_results as $record){
    $stock_data[] = [$record->timestamp,$record->value,$record->change_value,$record->change_percentage];
  }
  return $stock_data;
}

function add_new_entry($fetched_data){
  global $wpdb;
  $stock_data_table = $wpdb->prefix . "jam_stock_data";
  $timestamp = $fetched_data[0]['date']*1000;
  $value = str_replace('$', '', $fetched_data[0]['opening']);
  $change = str_replace('$', '', $fetched_data[0]['change']);
  $change_per = str_replace('%', '', $fetched_data[0]['change_per']);

  $wpdb->insert( $stock_data_table, array('timestamp' => $timestamp, 'value' => $value, 'change_value' => $change, 'change_percentage' => $change_per));
  return $wpdb->insert_id;
}

function update_local_file_storage($fetched_data){
  $file = get_home_path()."/wp-content/plugins/jam-stock-data-centre/lib/data.json";
  $timestamp = $fetched_data[0]['date']*1000;
  $value = str_replace('$', '', $fetched_data[0]['opening']);
  $content = ",[$timestamp, $value]";
  file_put_contents($file, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
}

if(isset($_POST['submit']) && $_POST['condition'] == 'Y'){
  $fetched_data = fetch_latest_stock_entry();
  $prev_stock_data = get_prev_stock_data();

  $last_updated = array_values($prev_stock_data)[0];
  $last_updated_date = date("Y-m-d",($last_updated[0]/1000));

  $fetched_date = date("Y-m-d",strtotime($fetched_data[0]['date']));

  if($fetched_date > $last_updated_date){
    $fetched_data[0]['date'] = strtotime($fetched_data[0]['date']);
    if(add_new_entry($fetched_data)){
      update_local_file_storage($fetched_data);
      echo "<strong>Latest stock entries updated.</strong>";
    }else{
      echo "<strong>Aborted!! Please try again...</strong>";
    }
  }else{
    echo "<strong>Already up to date.</strong>";
  }
}

// data to show on main screen
$prev_stock_data = get_prev_stock_data();
$current = array_values($prev_stock_data)[0];
$opening = $current[1];
$last_updated = $current[0]/1000;
$change_val = $current[2];
$change_per = $current[3];
$previous_close = end($prev_stock_data)[1];

// print '<pre>';
// print_r($current);
// print '</pre>';

?>

<h3>Jam Stock Data Information</h3>
<br>
<form method="post" action="">
  <input type="hidden" name="condition" value="Y">
  <input type="submit" name="submit" value="Fetch Latest">
</form>
<br>
<p>Opening Price $<?=$current[1]?></p>
<p>Change $<?=$change_val?></p> 
<p>Change Per <?=$change_per?>%</p>
<p>Last updated: <?=date('M d Y h:i A', $last_updated);?></p>
<p>Previous Close $<?=$previous_close?></p>

