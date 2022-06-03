<?php
	
    global $wpdb;
    $job_app_id = $_GET['job_application_id'];
    $job_app_table = $wpdb->prefix."job_applicants";
    $job_applicant_cv_url = $wpdb->get_results("SELECT cv_url FROM wp_job_applicants WHERE id=$job_app_id");
    $url = explode("uploads", $job_applicant_cv_url[0]->cv_url);
    $uploads = wp_upload_dir();
    $file_path = $uploads['basedir'].$url[1];
    wp_delete_file($file_path); //delete file here

    $wpdb->get_results("DELETE FROM $job_app_table WHERE id=$job_app_id");
    $wpdb->get_results("DELETE FROM wp_applicant_work_status WHERE applicant_id=$job_app_id");
    $wpdb->get_results("DELETE FROM wp_applicant_work_history WHERE applicant_id=$job_app_id");
    $wpdb->get_results("DELETE FROM wp_applicant_additional_info WHERE applicant_id=$job_app_id");
    $wpdb->get_results("DELETE FROM wp_applicant_education_history WHERE applicant_id=$job_app_id");
    $wpdb->get_results("DELETE FROM wp_job_applicant_requirement WHERE applicant_id=$job_app_id");
    
?>

<br><br>
<b>Job Deleted - Back to <a href="<?=$_SERVER['HTTP_REFERER']?>">Jobs Portal</a></b>

