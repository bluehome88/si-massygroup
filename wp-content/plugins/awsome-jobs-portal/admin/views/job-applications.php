<?php
global $wpdb;
$job_id = $_GET['job_id'];
$current_user = wp_get_current_user();
$roles = ( array ) $current_user->roles;
$where_clause = "";
$khc_flag = false;

if(!(in_array('job_portal_admin', $roles) || in_array('administrator', $roles))){
  $khc_flag = true;
  $where_clause .= " WHERE wj.key_hiring_contact_id=$current_user->ID ";
}
if(isset($job_id) && !empty($job_id) && $job_id != ''){
  if(!$khc_flag){
    $where_clause .= " WHERE ";
  }else{
    $where_clause .= " and ";
  }
  $where_clause .= "wja.job_id=$job_id ";
}

$job_applicants = $wpdb->get_results("SELECT wja.* FROM wp_job_applicants wja JOIN wp_jobs wj ON wja.job_id=wj.id $where_clause ORDER BY wja.created_at DESC");

?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?>
  <div class="clear"></div>
</div>

    
<div class="row jobsTable">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>Zip Code</th>
            <th>Country</th>
            <th>Detail</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($job_applicants as $key => $applicant):?>
          <tr>
            <td><?=$applicant->first_name?></td>
            <td><?=$applicant->last_name?></td>
            <td><?=$applicant->email?></td>
            <td><?=$applicant->area_code.$applicant->phone?></td>
            <td><?=$applicant->address_line_1?></td>
            <td><?=$applicant->city?></td>
            <td><?=$applicant->zip_code?></td>
            <td><?=$applicant->country?></td>
            <td>
              <a href="<?=admin_url()?>admin.php?page=applicant-details&applicant_id=<?=$applicant->id?>">View</a>
            </td>
            <td>
              <a href="<?=admin_url()?>admin.php?page=delete-job-application&job_application_id=<?=$applicant->id?>">
               <span class="dashicons dashicons-trash"></span>
              </a>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      </div>
    </div>