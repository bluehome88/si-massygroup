<?php
global $wpdb;
global $wp_country;
$sector_table = $wpdb->prefix."sector";
$job_title_table = $wpdb->prefix."job_title";
$function_table = $wpdb->prefix."function";
$jobs_table = $wpdb->prefix."jobs";

$jobs = $wpdb->get_results("SELECT jobs.*,sector.sector_title,job_title.title FROM $jobs_table AS jobs 
                INNER JOIN $sector_table AS sector ON jobs.sector_id =  sector.id
                INNER JOIN $job_title_table AS job_title ON jobs.job_title_id =  job_title.id
                ORDER BY jobs.created_at DESC");
?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <a href="<?=admin_url()?>admin.php?page=add-job">
    <button class="btn btn-primary" vlaue="add new">add new</button>
  </a>
  
  <div class="clear"></div>
</div>

    
<div class="row jobsTable">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>Key Hiring Contact</th>
            <th>Sector</th>
            <th>Title</th>
            <th>Company</th>
            <th>No. Of Applications</th>
            <th>City</th>
            <th>Country</th>
            <th>Salary(p/h)</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($jobs as $key => $job):?>
            <?php 
              $key_hiring_contact = get_user_by('id', $job->key_hiring_contact_id);
              $job_applications = $wpdb->get_results("SELECT count(*) as count FROM wp_job_applicants Where job_id=$job->id");
            ?>
          <tr>
            <td><?=$key_hiring_contact->user_email?></td>
            <td><?=$job->sector_title?></td>
            <td><?=$job->title?></td>
            <td><?=$job->job_company?></td>
            <td><a href="admin.php?page=job-applications&job_id=<?=$job->id?>"><?=$job_applications[0]->count?></a></td>
            <td><?=$job->job_city?></td>
            <!-- <td><?=$wp_country->name($job->job_country)?></td> -->
            <td><?=$job->job_country?></td>
            <td><?=$job->job_rate?></td>
            <td>
              <a href="<?=admin_url()?>admin.php?page=edit-job&job_id=<?=$job->id?>">
               <span class="dashicons dashicons-edit"></span>
             </a>
            </td>
            <td>
              <a href="<?=admin_url()?>admin.php?page=delete-job&job_id=<?=$job->id?>">
               <span class="dashicons dashicons-trash"></span>
             </a>
            </td>            
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      </div>
    </div>