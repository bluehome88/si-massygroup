<?php

$applicant_id = $_GET['applicant_id'];

global $wpdb;

$job_application['applicant'] = $wpdb->get_row("SELECT * FROM wp_job_applicants WHERE id = $applicant_id");
$job_application['applicant_work_status'] = $wpdb->get_row("SELECT * FROM wp_applicant_work_status WHERE applicant_id = $applicant_id");
$job_application['applicant_work_history'] = $wpdb->get_results("SELECT * FROM wp_applicant_work_history WHERE applicant_id = $applicant_id");
$job_application['applicant_additional_info'] = $wpdb->get_row("SELECT * FROM wp_applicant_additional_info WHERE applicant_id = $applicant_id");
$job_application['applicant_education_history'] = $wpdb->get_results("SELECT * FROM wp_applicant_education_history WHERE applicant_id = $applicant_id");

$job_application['job_applicant_requirement'] = $wpdb->get_results("SELECT wp_job_requirements.req_text,jar.is_check 
												FROM wp_job_requirements
												INNER JOIN wp_job_applicant_requirement AS jar ON
												wp_job_requirements.id = jar.job_requirement_id
												INNER JOIN wp_job_applicants ON
												jar.applicant_id = wp_job_applicants.id
												WHERE jar.applicant_id = $applicant_id
												");
// SELECT products.*, shops.shop_name
// FROM products
// INNER JOIN shops_products
// ON products.product_id = shops_products.product_id
// INNER JOIN shops
// ON shops_products.shop_id = shops.shop_id
// WHERE shops_products.shop_id = 3

// print "<pre>";
// print_r($job_application);
// print "</pre>";
// exit();
?>
<div class="container">
  <h2>Review Application</h2>
  <ul class="nav nav-pills application__details">
    <li class="active"><a data-toggle="pill" href="#details">Applicant Details</a></li>
    <li><a data-toggle="pill" href="#rq">Job Requirement Questions</a></li>
    <li><a data-toggle="pill" href="#work_history">Current Work Status</a></li>
    <li><a data-toggle="pill" href="#employment_history">Employment History</a></li>
    <li><a data-toggle="pill" href="#education_history">Education History</a></li>
    <li><a data-toggle="pill" href="#additional_info">Additional Info</a></li>
  </ul>
  <hr />
  <div class="tab-content">
    

    
    <div id="details" class="tab-pane active">
    	<div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['applicant'] as $key => $value):if($key == 'id' || $key == 'job_id') continue;?>
      <div class="row">
        <div class="col-sm-6">
      		<div class="row" >
        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $key))?>
        		</p>
        	</div>
        </div>
        <div class="col-sm-6">
        	<!-- <?=($key == 'cv_url') ? '<a href="$value" target="_blank" download>Download</a>' : $value?> -->
          <?php
          if($key == 'cv_url'){
          ?>
            <a href="<?=$value?>" target="_blank" download>Download</a>
          <?php
          }else{

            echo "<p>".$value."</p>";
          }
          ?>
        </div>
      </div>
      <hr />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>

    <div id="rq" class="tab-pane fade">
    	<div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['job_applicant_requirement'] as $key => $value):?>
      <div class="row">
        <div class="col-sm-6">
      		<div class="row" >
        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $value->req_text))?>
        		</p>
        	</div>
        </div>
        <div class="col-sm-6">
        	<?=($value->is_check)? '<p>Yes</p>' : '<p>No</p>'?>
        </div>
      </div>
      <hr />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>

    <div id="work_history" class="tab-pane fade">
      <div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['applicant_work_status'] as $key => $value):if($key == 'id' || $key == 'applicant_id') continue;?>
      <div class="row">
        <div class="col-sm-6">
      		<div class="row" >
        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $key))?>
        		</p>
        	</div>
        </div>
        <div class="col-sm-6">
        	<?=
          '<p>'.$value.'</p>'
          ?>
        </div>
      </div>
      <hr />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>
    <div id="employment_history" class="tab-pane fade">
      <div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['applicant_work_history'] as $key => $array):?>
	      <?php foreach ($array as $field => $value) {if($field == 'id' || $field == 'applicant_id') continue;?>
	      	<div class="row">
	        	<div class="col-sm-6">
	        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $field))?>
	        	</p>
	        	</div>
	        	<div class="col-sm-6">
	        		<?=
              '<p>'.$value.'</p>'
              ?>
	        	</div>
	      	</div>
	      	<hr />	
	      <?php }?>
	      
      <hr style="border-top: dotted 1px;" />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>
    <div id="education_history" class="tab-pane fade">
      <div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['applicant_education_history'] as $key => $array):?>
	      <?php foreach ($array as $field => $value) {if($field == 'id' || $field == 'applicant_id') continue;?>
	      	<div class="row">
	        	<div class="col-sm-6">
	        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $field))?>
	        	</p>
	        	</div>
	        	<div class="col-sm-6">
	        		<?= '<p>'.$value.'</p>' ?>
	        	</div>
	      	</div>
	      	<hr />	
	      <?php }?>
	      
      <hr style="border-top: dotted 1px;" />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>
    <div id="additional_info" class="tab-pane fade">
      <div class="container-fluid">
      <div class="row">
    <div class="col-sm-8">
      <?php foreach($job_application['applicant_additional_info'] as $key => $value):if($key == 'id' || $key == 'applicant_id') continue;?>
      <div class="row">
        <div class="col-sm-6">
      		<div class="row" >
        		<p class="col-sm-12 font-weight-bold"><?=ucwords(str_replace("_", " ", $key))?>
        		</p>
        	</div>
        </div>
        <div class="col-sm-6">
        	<?='<p>'.$value.'</p>'?>
        </div>
      </div>
      <hr />
  <?php endforeach;?>
    </div>
    <div class="col-sm-4"></div>
  </div>
    </div>
    </div>
  </div>
</div>