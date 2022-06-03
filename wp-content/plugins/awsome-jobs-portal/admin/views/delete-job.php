<?php
	
    global $wpdb;
    $job_id = $_GET['job_id'];
    $job_table = $wpdb->prefix."jobs";
    $wpdb->get_results("DELETE FROM $job_table WHERE id=$job_id");
?>

<br><br>
<b>Job Deleted - Back to <a href="<?=$_SERVER['HTTP_REFERER']?>">Jobs Portal</a></b>

