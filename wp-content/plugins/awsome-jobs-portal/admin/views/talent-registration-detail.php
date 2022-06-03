<?php
	
    global $wpdb;
    $id = $_GET['id'];
    
    $career_registration = $wpdb->get_results("SELECT * FROM wp_career_registrations WHERE id=$id");

    $career_registration = $career_registration[0];
?>
<div class="wrap dash-talent-reg">
 
    <h1><?php echo get_admin_page_title(); ?></h1>
    <?php    echo "<h2>" . __( 'Career Registration Details', 'jobs_trdom' ) . "</h2>"; ?>
    <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-primary back_btn">Back</a>  
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>First Name</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->first_name?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Last Name</h6>
        </div>
         <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->last_name?></p>
        </div>
    </div>
        
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Email</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->email?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Phone</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->area_code.$career_registration->phone?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Address</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->address_line_1?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>City</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->city?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>State</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->state?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Zip Code</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->zip_code?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <h6>country</h6>
        </div>
        <div class="col-sm-4 col-md-4">
            <p><?=$career_registration->country?></p>
        </div>
    </div>
     <div class="row">
        <div class="col-sm-4 col-md-4">
            <h6>Citizen</h6>
        </div>
        <div class="col-sm-4 col-md-4">
            <p><?=ucwords($career_registration->citizen)?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Interest in Massy</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->interest_in_massy?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <h6>Additional Info</h6>
        </div>
        <div class="col-sm-6 col-md-4">
            <p><?=$career_registration->additional_info?></p>
        </div>
    </div>
  
    <a class="download__link" href="<?=$career_registration->cv_url?>" target="_blank" download>Download Resume</a>
</div>
