<?php

global $wpdb;

$fyears_table = $wpdb->prefix . "financial_years";
$income_statement_information = $wpdb->prefix . 'income_statement_information';
$balance_sheet_information = $wpdb->prefix . 'balance_sheet_information';
$balance_sheet_quality_measures = $wpdb->prefix . 'balance_sheet_quality_measures';
$cash_flow_information = $wpdb->prefix . 'cash_flow_information';
$isi_fyears = $wpdb->prefix . 'isi_fyears';
$bsi_fyears = $wpdb->prefix . 'bsi_fyears';
$bsqm_fyears = $wpdb->prefix . 'bsqm_fyears';
$cfi_fyears = $wpdb->prefix . 'cfi_fyears';

$fyears = $wpdb->get_results("SELECT year FROM $fyears_table AS fy ORDER BY id");

$income_stmt_infos = $wpdb->get_results("SELECT fy.year,isi.entry_title,isfy.value,isfy.id as isfy_id 
  FROM $fyears_table AS fy 
  LEFT JOIN $isi_fyears AS isfy ON isfy.fy_id = fy.id 
  LEFT JOIN $income_statement_information AS isi ON isi.id = isfy.isi_id 
  ORDER BY fy.year, isi.id ASC");

$blc_sheet_infos = $wpdb->get_results("SELECT fy.year,bsi.entry_title,bsfy.value,bsfy.id as bsfy_id 
  FROM $fyears_table AS fy
  LEFT JOIN $bsi_fyears AS bsfy ON bsfy.fy_id = fy.id
  LEFT JOIN $balance_sheet_information AS bsi ON bsi.id = bsfy.bsi_id 
  ORDER BY fy.year, bsi.id ASC");

$blc_sheet_qa_infos = $wpdb->get_results("SELECT fy.year,bsqm.entry_title,bsqfy.value,bsqfy.id as bsqfy_id
  FROM $fyears_table AS fy 
  LEFT JOIN $bsqm_fyears AS bsqfy ON bsqfy.fy_id = fy.id
  LEFT JOIN $balance_sheet_quality_measures AS bsqm ON bsqm.id = bsqfy.bsqm_id 
  ORDER BY fy.year, bsqm.id ASC");

$cash_flow_infos = $wpdb->get_results("SELECT cfi.entry_title,fy.year,cffy.value,cffy.id as cffy_id
  FROM $fyears_table AS fy 
  LEFT JOIN $cfi_fyears AS cffy ON cffy.fy_id = fy.id
  LEFT JOIN $cash_flow_information AS cfi ON cfi.id = cffy.cfi_id 
  ORDER BY fy.year, cfi.id ASC");

$income_stmt_infos_data = $points1 = array();
$blc_sheet_infos_data = $points2 = array();
$blc_sheet_qa_infos_data = $points3 = array();
$cash_flow_infos_data = $points4 = array();
$key1 = $key2 = $key3 = $key4 = '';

/* Group Income Statement Information data by year */
foreach ($income_stmt_infos as $income_stmt_info){
  
  if($key1 != $income_stmt_info->year){
    $key1 = $income_stmt_info->year;
  }

  // List of points of Income Statement Information Block
  if(!in_array($income_stmt_info->entry_title, $points1)){
    $points1[] = $income_stmt_info->entry_title;
  }

  $income_stmt_infos_data[$key1][$income_stmt_info->entry_title]['rec_id'] = $income_stmt_info->isfy_id;
  $income_stmt_infos_data[$key1][$income_stmt_info->entry_title]['value'] = $income_stmt_info->value;
}
ksort($income_stmt_infos_data);


/* Group Balance Sheet Information data by year */
foreach ($blc_sheet_infos as $blc_sheet_info){
  
  if($key2 != $blc_sheet_info->year){
    $key2 = $blc_sheet_info->year;
  }

  // List of points of Balance Sheet Information Block
  if(!in_array($blc_sheet_info->entry_title, $points2)){
    $points2[] = $blc_sheet_info->entry_title;
  }

  $blc_sheet_infos_data[$key2][$blc_sheet_info->entry_title]['rec_id'] = $blc_sheet_info->bsfy_id;
  $blc_sheet_infos_data[$key2][$blc_sheet_info->entry_title]['value'] = $blc_sheet_info->value;
}
ksort($blc_sheet_infos_data);


/* Group Balance Sheet Quality Measures data by year */
foreach ($blc_sheet_qa_infos as $blc_sheet_qa_info){
  
  if($key3 != $blc_sheet_qa_info->year){
    $key3 = $blc_sheet_qa_info->year;
  }

  // List of points of Balance Sheet Quality Measures Block
  if(!in_array($blc_sheet_qa_info->entry_title, $points3)){
    $points3[] = $blc_sheet_qa_info->entry_title;
  }

  $blc_sheet_qa_infos_data[$key3][$blc_sheet_qa_info->entry_title]['rec_id'] = $blc_sheet_qa_info->bsqfy_id;
  $blc_sheet_qa_infos_data[$key3][$blc_sheet_qa_info->entry_title]['value'] = $blc_sheet_qa_info->value;
}
ksort($blc_sheet_qa_infos_data);


/* Group Cash Flow Information data by year */
foreach ($cash_flow_infos as $cash_flow_info){
  
  if($key4 != $cash_flow_info->year){
    $key4 = $cash_flow_info->year;
  }

  // List of points of Cash Flow Information Block
  if(!in_array($cash_flow_info->entry_title, $points4)){
    $points4[] = $cash_flow_info->entry_title;
  }

  $cash_flow_infos_data[$key4][$cash_flow_info->entry_title]['rec_id'] = $cash_flow_info->cffy_id;
  $cash_flow_infos_data[$key4][$cash_flow_info->entry_title]['value'] = $cash_flow_info->value;
}
ksort($cash_flow_infos_data);

?>

<div class="container-fluid">
  <div class="row" style="margin-top: 30px;margin-bottom: 10px;">
    <h2 style="margin: 0px 20px;"><?php echo get_admin_page_title(); ?></h2>
    <a href="<?=admin_url()?>admin.php?page=financial-data-entry">
      <button class="btn btn-primary">List View</button>
    </a>
    
    <div class="clear"></div>
  </div>
  <h5 style="margin: 0px 0px;">(Double click on the value to edit)</h5>

  <div class="main_Content">
    <!--  Five year results -->
    <div class="fiveYearResults" id="fiveyearResult">
      <div class="main_content_inner flex-column">
        <div class="d-flex">
          <div class="firstCol">
            <h5 class="head">Income Statement Information</h5>
            <?php foreach ($points1 as $point):?>
              <p><?=$point?></p>
            <?php endforeach;?>
          </div>
          <?php foreach ($income_stmt_infos_data as $year => $yearly_recs):?>
            <div class="secondCol">
              <h5><?=$year?></h5>
              <?php foreach ($yearly_recs as $rec):?>
                <p id="rec-<?=$isi_fyears?>-<?=$rec['rec_id']?>" ondblclick="toEditable('rec-<?=$isi_fyears?>-<?=$rec['rec_id']?>')" onfocusout="saveValue('<?=$rec['rec_id']?>', '<?=$isi_fyears?>')"><?=$rec['value']?></p>
              <?php endforeach;?>
            </div>
          <?php endforeach;?>
        </div>

        <div class="d-flex">
          <div class="firstCol">
            <h5 class="head">Balance Sheet Information</h5>
            <?php foreach ($points2 as $point):?>
              <p><?=$point?></p>
            <?php endforeach;?>
          </div>
          <?php foreach ($blc_sheet_infos_data as $yearly_recs):?>
            <div class="secondCol m_top">
              <?php foreach ($yearly_recs as $rec):?>
                <p id="rec-<?=$bsi_fyears?>-<?=$rec['rec_id']?>" ondblclick="toEditable('rec-<?=$bsi_fyears?>-<?=$rec['rec_id']?>')" onfocusout="saveValue('<?=$rec['rec_id']?>', '<?=$bsi_fyears?>')"><?=$rec['value']?></p>
              <?php endforeach;?>
            </div>
          <?php endforeach;?>
        </div>

        <div class="d-flex">
          <div class="firstCol">
            <h5 class="head">Balance Sheet Quality Measures</h5>
            <?php foreach ($points3 as $point):?>
              <p><?=$point?></p>
            <?php endforeach;?>
          </div>
          <?php foreach ($blc_sheet_qa_infos_data as $yearly_recs):?>
            <div class="secondCol m_top">
              <?php foreach ($yearly_recs as $rec):?>
                <p id="rec-<?=$bsqm_fyears?>-<?=$rec['rec_id']?>" ondblclick="toEditable('rec-<?=$bsqm_fyears?>-<?=$rec['rec_id']?>')" onfocusout="saveValue('<?=$rec['rec_id']?>', '<?=$bsqm_fyears?>')"><?=$rec['value']?></p>
              <?php endforeach;?>
            </div>
          <?php endforeach;?>
        </div>

        <div class="d-flex">
          <div class="firstCol">
            <h5 class="head">Cash Flow Information</h5>
            <?php foreach ($points4 as $point):?>
              <p><?=$point?></p>
            <?php endforeach;?>
          </div>
          <?php foreach ($cash_flow_infos_data as $yearly_recs):?>
            <div class="secondCol m_top">
              <?php foreach ($yearly_recs as $rec):?>
                <p id="rec-<?=$cfi_fyears?>-<?=$rec['rec_id']?>" ondblclick="toEditable('rec-<?=$cfi_fyears?>-<?=$rec['rec_id']?>')" onfocusout="saveValue('<?=$rec['rec_id']?>', '<?=$cfi_fyears?>')"><?=$rec['value']?></p>
              <?php endforeach;?>
            </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</div>
