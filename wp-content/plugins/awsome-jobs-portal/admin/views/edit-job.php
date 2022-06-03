<?php
	global $wp_country;
    global $wpdb;
    $job_id = $_GET['job_id'];
    
    $sector_table = $wpdb->prefix."sector";
    $job_title_table = $wpdb->prefix."job_title";
    $function_table = $wpdb->prefix."function";
    $job_table = $wpdb->prefix."jobs";
    $job_requirement_table = $wpdb->prefix."job_requirements";

    if($_POST){
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $timestamp = date('Y-m-d H:i:s');
    	$result = $wpdb->update(
    		$job_table, 
		    	array( 
		        	'job_title_id' => $_POST['job_title_id'], 
	                // 'job_title' => $_POST['job_title'], 
	                'sector_id' => $_POST['sector_id'],
	                'function_id' => $_POST['function_id'],
	                'job_city' => $_POST['job_city'],
                    'job_country' => $_POST['job_country'],
	                'job_to_date' => $_POST['to_date'],
	                'job_rate' => $_POST['job_rate'],
	                'job_company' => $_POST['job_company'], 
                    'short_description' => $_POST['short_description'],
	                'job_description' => $_POST['job_description'],
	                'job_status' => $_POST['job_status'],
                    'key_hiring_contact_id' => $_POST['key_hiring_contact_id'],
                    'updated_at' => $timestamp
		    	), 
		   	 	array(
		        	"id" => $_POST['job_id']
		    	)	 
		);
		if ( isset($_POST['req']) && !empty($_POST['req']) ) {
			$wpdb->delete( $job_requirement_table, array( 'job_id' => $_POST['job_id'] ) );
            foreach ($_POST['req'] as $key => $req) {
                if(!empty($req) && $req != ''){
                    $wpdb->insert( $job_requirement_table, array( 'job_id' => $_POST['job_id'],'req_text' => $req));                
                }
            }
		}
    	?>
    		<div class="updated"><p><strong><?php _e('Job Edited.' ); ?></strong></p></div>
    	<?php
	}

    $sectors = $wpdb->get_results("SELECT * FROM $sector_table");
    $job_titles = $wpdb->get_results("SELECT * FROM $job_title_table");
    $functions = $wpdb->get_results("SELECT * FROM $function_table");

    $job = $wpdb->get_row("SELECT * FROM $job_table WHERE id = $job_id");
    $job_requirements = $wpdb->get_results("SELECT * FROM wp_job_requirements WHERE job_id = $job->id");

    $args = array(
        'role'    => 'key_hiring_contact',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    );
    $users = get_users( $args );
    // $companies = get_posts(array( 'post_type' => 'companies','posts_per_page' => -1, 'orderby' => 'title','order'   => 'ASC' ));

    // echo "<pre>";
    // print_r($companies);
    // exit();
?>
<div class="wrap">
 
    <h1><?php echo get_admin_page_title(); ?></h1>

    <?php    echo "<h2>" . __( 'Edit Job', 'jobs_trdom' ) . "</h2>"; ?>
    
    <form name="jobs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="jobs_hidden" value="Y">
        <input type="hidden" name="job_id" value="<?=$job->id?>">
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>Key Hirirng Contact</h3>
                <select class="form-control" name="key_hiring_contact_id">
                    <!-- <option></option> -->
                    <?php foreach ($users as $key => $user) {?>
                        <option value="<?=$user->ID?>" <?=($job->key_hiring_contact_id == $user->ID) ? "selected" : ""?>><?=ucwords(str_replace("_", " ", $user->display_name))?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>To Date</h3>
                <input class="form-control" type="date" name="to_date" size="20" value="<?=(isset($job->job_to_date))  ? date_format(date_create($job->job_to_date),"yy-m-d") : ""?>" />
            </div> 
        </div>
        <div class="row mt-3">
            
            <div class="col-sm-6 col-md-3">
                <h3>Select Title</h3>
                <select class="form-control" name="job_title_id" >
                    <?php foreach ($job_titles as $key => $job_title) {?>
                        <option value="<?=$job_title->id?>" <?=($job->job_title_id == $job_title->id) ? "selected" : ""?>><?=$job_title->title?></option>
                    <?php }?>
                </select>
            </div>
            <!-- <div class="col-sm-6 col-md-3">
                <h3>Position</h3>
                <input class="form-control" type="text" name="job_title" size="20" value="<?=(isset($job->job_title))  ? $job->job_title : ""?>" />
            </div> -->
            <div class="col-sm-6 col-md-3">
                <h3>Company</h3>
                <input class="form-control" type="text" name="job_company" size="20" value="<?=(isset($job->job_company))  ? $job->job_company : ""?>" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>Sector</h3>
                <select class="form-control" name="sector_id" >
                    <?php foreach ($sectors as $key => $sector) {?>
                        <option value="<?=$sector->id?>" <?=($job->sector_id == $sector->id) ? "selected" : ""?>><?=$sector->sector_title?></option>
                    <?php }?>
                </select>
            </div>
            
            <div class="col-sm-6 col-md-3">
                <h3>Functions</h3>
                <select class="form-control" name="function_id" >
                    <?php foreach ($functions as $key => $function) {?>
                        <option value="<?=$function->id?>" <?=($job->function_id == $function->id) ? "selected" : ""?>><?=$function->function_title?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>City</h3>
                <input class="form-control" type="text" name="job_city" size="20" value="<?=(isset($job->job_city))  ? $job->job_city : ""?>" />
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>Country</h3>
                <select class="form-control" name="job_country" >
                    <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                        <option value="<?=$country?>" <?=($job->job_country == $country) ? "selected" : ""?>><?=$country?></option>
                    <?php }?>
                </select>
            </div>
            
        </div>
        <div class="row mt-3">

            <div class="col-sm-6 col-md-3">
                <h3>Salary(per/hour)</h3>
                <input class="form-control" type="text" name="job_rate" size="20" value="<?=(isset($job->job_rate))  ? $job->job_rate : ""?>" />
            </div>
            
            <div class="col-sm-6 col-md-3">
                <h3>Status</h3>
                <select class="form-control" name="job_status" >
                    <option value="active" <?=($job->job_status == 'active') ? "selected" : ""?>>Active</option>
                    <option value="inactive" <?=($job->job_status == 'inactive') ? "selected" : ""?>>Inactive</option>
                </select>
            </div>
            
        </div>
        <!-- <div class="row">
            <div class="col-sm-6 col-md-6">
                <h3>Company</h3>
                <select class="form-control" name="job_company" >
                    <?php foreach ($companies as $company) {?>
                        <option value="<?=$company->ID?>" <?=($job->job_company == $company->ID) ? "selected" : ""?>><?=$company->post_title?></option>
                    <?php }?>
                </select>
            </div>
        </div> -->
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <h3>Short Description</h3>
                <?=wp_editor( (isset($job->short_description))  ? $job->short_description : "",'short_description',array( 'media_buttons' => false ));?>
                <!-- <textarea class="form-control" name="job_description" rows="10" ><?=(isset($job->job_description))  ? $job->job_description : ""?></textarea> -->
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <h3>Description</h3>
                <?=wp_editor( (isset($job->job_description))  ? $job->job_description : "",'job_description',array( 'media_buttons' => false ));?>
                <!-- <textarea class="form-control" name="job_description" rows="10" ><?=(isset($job->job_description))  ? $job->job_description : ""?></textarea> -->
            </div>
        </div>
        <br>
            <p>
                  <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    +Requirement Questions
                  </a>
                </p>
                <div class="collapse" id="collapseExample">
                  <div class="card card-block">
                        <?php if(!empty($job_requirements)): ?>
                        <?php foreach($job_requirements as $req):?>
                        <div class="row input-req">
                            
                            <div class="col-sm-6 col-md-10">
                                <input class="form-control" type="text" name="req[]" value="<?=$req->req_text?>" placeholder="Enter Requirement ..." />
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <span id="trashii" class="dashicons dashicons-no trash"></span>
                            </div>

                        </div>
                        <br />
                    <?php endforeach;?>
                    <?php else:?>
                        <div class="row">
                            <div class="col-sm-6 col-md-10">
                                <input class="form-control" type="text" name="req[]" value="" placeholder="Enter Requirement ..." />
                            </div>
                            

                        </div>
                        <br />
                    <?php endif;?>
                        <div id="req_row" class="row">
                            <div class="col-sm-6 col-md-6">
                                <button id="add_more_req" class="btn btn-primary" type="button"><span class="dashicons dashicons-plus-alt"></span> - Add More Questions</button>
                                                    <!-- <input class="form-control" type="button" name="" value="Add More Requirements" size="20" /> -->
                            </div>
                        </div>           
                  </div>
                </div>
        <br>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Update', 'jobs_trdom' ) ?>" />
            </div>
        </div>
        
    </form>

    <!--<?php //echo do_shortcode("[test]"); ?>-->

</div><!-- .wrap -->