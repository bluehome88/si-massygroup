<?php 
global $wp_country;
    global $wpdb;
    $sector_table = $wpdb->prefix."sector";
    $job_title_table = $wpdb->prefix."job_title";
    $function_table = $wpdb->prefix."function";

    $sectors = $wpdb->get_results("SELECT * FROM $sector_table");
    $job_titles = $wpdb->get_results("SELECT * FROM $job_title_table");
    $functions = $wpdb->get_results("SELECT * FROM $function_table");

    $args = array(
        'role'    => 'key_hiring_contact',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    );
    $users = get_users( $args );

    // $companies = get_posts(array('post_type' => 'companies','posts_per_page' => -1, 'orderby' => 'title','order'   => 'ASC'));
	if(isset($_POST['jobs_hidden']) && $_POST['jobs_hidden'] == 'Y') {
        
        // echo "<pre>";
        // print_r($_POST['req']);
        // exit();
        $job_table = $wpdb->prefix."jobs";
        $job_requirement_table = $wpdb->prefix.'job_requirements';
        $timestamp = date('Y-m-d H:i:s');
        $wpdb->insert( 
            $job_table, 
            array( 
                'job_title_id' => $_POST['job_title_id'], 
                // 'job_title' => $_POST['job_title'], 
                'sector_id'   => $_POST['sector_id'],
                'function_id' => $_POST['function_id'],
                'job_city' => $_POST['job_city'],
                'job_country' => $_POST['job_country'],
                'job_to_date'     => $_POST['to_date'],
                'job_rate' => $_POST['job_rate'],
                'job_company' => $_POST['job_company'], 
                'short_description' => $_POST['short_description'],
                'job_description' => $_POST['job_description'],
                'job_status' => $_POST['job_status'],
                'key_hiring_contact_id' => $_POST['key_hiring_contact_id'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            )  
        );

        $job_id = $wpdb->insert_id;
        // echo gettype($job_id).'kkljkjkljlkjlkjlkj';exit();
        if ( isset($_POST['req']) && !empty($_POST['req']) ) {
            foreach ($_POST['req'] as $key => $req) {
                $wpdb->insert( $job_requirement_table, array( 'job_id' => $job_id,'req_text' => $req));                
            }
        }

        ?>
        <div class="updated"><p><strong><?php _e('New job posted.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
    } 
?>

<div class="wrap">
 
    <h1><?php echo get_admin_page_title(); ?></h1>

    <?php    echo "<h2>" . __( 'Add Job', 'jobs_trdom' ) . "</h2>"; ?>
    
    <form name="jobs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="jobs_hidden" value="Y">
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>Key Hirirng Contact</h3>
                <select class="form-control" name="key_hiring_contact_id">
                    <!-- <option></option> -->
                    <?php foreach ($users as $key => $user) {?>
                        <option value="<?=$user->ID?>"><?=ucwords(str_replace("_", " ", $user->display_name))?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>To Date</h3>
                <input class="form-control" type="date" name="to_date" size="20" />
            </div> 
        </div>
        <div class="row mt-3">
            
            <div class="col-sm-6 col-md-3">
                <h3>Select Title</h3>
                <select class="form-control" name="job_title_id" >
                    <?php foreach ($job_titles as $key => $job_title) {?>
                        <option value="<?=$job_title->id?>"><?=$job_title->title?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>Company</h3>
                <input class="form-control" type="text" name="job_company" size="20" />
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>Sector</h3>
                <select class="form-control" name="sector_id" >
                    <?php foreach ($sectors as $key => $sector) {?>
                        <option value="<?=$sector->id?>"><?=$sector->sector_title?></option>
                    <?php }?>
                </select>
            </div>
            
            <div class="col-sm-6 col-md-3">
                <h3>Functions</h3>
                <select class="form-control" name="function_id" >
                    <?php foreach ($functions as $key => $function) {?>
                        <option value="<?=$function->id?>"><?=$function->function_title?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>City</h3>
                <input class="form-control" type="text" name="job_city" size="20" />
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>Country</h3>
                <select class="form-control" name="job_country" >
                    <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                        
                            <option value="<?=$country?>" ><?=$country?></option>
                    <?php }?>
                </select>
            </div>

            
        </div>
        <div class="row mt-3">
            <div class="col-sm-6 col-md-3">
                <h3>Salary(per/hour)</h3>
                <input class="form-control" type="number" name="job_rate" size="20" />
            </div>
            <div class="col-sm-6 col-md-3">
                <h3>Status</h3>
                <select class="form-control" name="job_status" >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    
                </select>
            </div>
            
        </div>

        <!-- <div class="row">
            <div class="col-sm-6 col-md-6">
                <h3>Company</h3>
                <select class="form-control" name="job_company" >
                    <?php foreach ($companies as $company) {?>
                        <option value="<?=$company->ID?>"><?=$company->post_title?></option>
                    <?php }?>
                </select>
            </div>
        </div> -->
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <h3>Short Description</h3>
                <?=wp_editor('','short_description',array( 'media_buttons' => false ));?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <h3>Description</h3>
                <?=wp_editor('job description','job_description',array( 'media_buttons' => false ));?>
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
                <div class="row">
                    <div class="col-sm-6 col-md-10">
                        <input class="form-control" type="text" name="req[]" value="" placeholder="Enter Requirement ..." />
                    </div>

                </div>
                <br>
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
                <input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Post Job', 'jobs_trdom' ) ?>" />
            </div>
        </div>
        
    </form>

    <!--<?php //echo do_shortcode("[test]"); ?>-->

</div><!-- .wrap -->
