<?php
namespace AwsomeJobPortal\Lib;
use AwsomeJobPortal\Widgets\MyWidget as FirstWidget;
use AwsomeJobPortal\Lib\Menu as adminMenu;
use AwsomeJobPortal\Lib\Settings;
class Plugin{
        public function run(){
                
                add_action('init', array($this, 'init_awsome_jobs_portal'));
                add_action('widgets_init', array($this, 'init_portal_widgets'));
                add_action('wp_head', array($this,'myplugin_ajaxurl'));
                add_filter( 'query_vars', array($this, 'custom_query_vars_filter') );
                add_action('admin_menu', array($this, 'add_menu'));
                
                add_action( 'admin_post_nopriv_career_registration', array($this,'process_career_registration') );
                add_action( 'admin_post_career_registration', array($this,'process_career_registration') );

                add_action( 'admin_post_nopriv_create_challenge', array($this,'process_create_challenge') );
                add_action( 'admin_post_create_challenge', array($this,'process_create_challenge') );
                
                add_action( 'admin_post_nopriv_process_challenge_form', array($this,'process_challenge_form') );
                add_action( 'admin_post_process_challenge_form', array($this,'process_challenge_form') );

                add_action( 'admin_post_nopriv_job_application', array($this,'process_job_application') );
                add_action( 'admin_post_job_application', array($this,'process_job_application') );

                add_action( 'wp_ajax_get_function_by_sector', array($this,'process_get_function_by_sector') );
                add_action( 'wp_ajax_nopriv_get_function_by_sector', array($this,'process_get_function_by_sector') );

                add_action( 'wp_ajax_get_function_by_country', array($this,'process_get_function_by_country') );
                add_action( 'wp_ajax_nopriv_get_function_by_country', array($this,'process_get_function_by_country') );

                add_action( 'wp_ajax_get_job_by_function', array($this,'process_get_job_by_function') );
                add_action( 'wp_ajax_nopriv_get_job_by_function', array($this,'process_get_job_by_function') );

                add_action( 'wp_ajax_get_job_by_id', array($this,'process_get_job_by_id') );
                add_action( 'wp_ajax_nopriv_get_job_by_id', array($this,'process_get_job_by_id') );

                add_action( 'wp_ajax_del_data_byId', array($this,'process_del_data_byId') );
                add_action( 'wp_ajax_nopriv_del_data_byId', array($this,'process_del_data_byId') );
        }

        function myplugin_ajaxurl() {

           echo '<script type="text/javascript">
                   var ajp_ajaxurl = "' . admin_url('admin-ajax.php') . '";
                 </script>';
        }

        function init_awsome_jobs_portal(){
            
        }

        function process_del_data_byId(){
            global $wpdb;
            switch ($_POST['table']) {
                case 'wp_sector':
                     $wpdb->query('DELETE  FROM '.$_POST['table'].' WHERE id = "'.$_POST['id'].'"');
                     echo true;
                    break;
                case 'wp_function':
                    $wpdb->query('DELETE  FROM '.$_POST['table'].' WHERE id = "'.$_POST['id'].'"');
                    echo true;
                break;
                case 'wp_job_title':
                    $wpdb->query('DELETE  FROM '.$_POST['table'].' WHERE id = "'.$_POST['id'].'"');
                    echo true;
                break;
                
                default:
                    $wpdb->query('DELETE  FROM '.$_POST['table'].' WHERE id = "'.$_POST['id'].'"');
                    echo true;
                    break;
            }
            wp_die();
        }
        function process_get_job_by_id(){
            $job_id = $_POST['job_id'];
            global $wpdb;
            global $wp_country;
            $job = $wpdb->get_row("SELECT * FROM wp_jobs WHERE id = $job_id");
            $job->requirements = $wpdb->get_results("SELECT * FROM wp_job_requirements WHERE job_id = $job->id");?>
            <div class="col-md-4  padding-20">
               <h5 class="yellow-text bold">Job Description</h5>
               <small><div class="white-text"><span class="yellow-text">Location:</span>  <?=$job->job_city?> / <?=$wp_country->name($job->job_country)?> </div></small>
               <small><div class="white-text"><span class="yellow-text">Salary:</span>  <?=$job->job_rate?> per/hr </div></small>
               <br>
               <?php foreach ($job->requirements as $requirement):?>
                 <a href="" class="yellow-text webkit-box">- <?=$requirement->req_text?></a>
               <?php endforeach;?>

             </div>
             <div class="col-md-8 padding-no-lr">
               
              <small> <div class="white-text"><?=$job->short_description?></div></small>
            <br>
            <div class="col-md-3"></div>
            <?php 
              $url = get_permalink( get_page_by_path( 'careers/jobs' ) );
              $params = array(
                'sector_id' => base64_encode($sectors_with_data[0]['sector']->id) ,
                'title_id' => base64_encode($sectors_with_data[0]['functions'][0]->id) 
                );
              // $params = array(
              //   'sector' => base64_encode( $sectors_with_data[0]['sector']->id ),
              //   'title' => base64_encode($sectors_with_data[0]['titles'][0]->id)
              //   );
            ?>
               <a href="<?=get_permalink( get_page_by_path( 'careers/jobs' ) )?>" class="contact_information__button yelow-button  text-center col-md-6">View Listing</a>
             </div>
            <?php 
            wp_die();
        }
        function process_get_job_by_function(){
            global $wpdb;

            switch ($_POST['col_1']) {
                case 'sector':
                    $sector_id = $_POST['id'];
                    $function_id = $_POST['function_id'];
                    $jobs = $wpdb->get_results("SELECT wp_jobs.id,wp_job_title.title FROM wp_jobs
                                                INNER JOIN wp_job_title ON wp_jobs.job_title_id = wp_job_title.id 
                                                WHERE sector_id = $sector_id AND function_id = $function_id AND job_status='active'");
                    
                    foreach($jobs as $key => $job):?>
                     
                         <div class="<?=($key == 0)? 'list_active' : '';?> list-search">
                          <a href="javascript:void(0)" class="single-item <?=($key != 0)? 'white-text' : '';?>" id="<?=$job->id?>">
                            <?=$job->title?>
                          </a>
                        </div>

                    <?php endforeach;
                    break;
                    case 'country':
                    $code = $_POST['id'];
                    $function_id = $_POST['function_id'];
                    $jobs = $wpdb->get_results("SELECT wp_jobs.id,wp_job_title.title FROM wp_jobs
                                                INNER JOIN wp_job_title ON wp_jobs.job_title_id = wp_job_title.id 
                                                WHERE job_country = '".$code."' AND function_id = $function_id AND job_status='active'");
                    
                    foreach($jobs as $key => $job):?>
                     
                         <div class="<?=($key == 0)? 'list_active' : '';?> list-search">
                          <a href="javascript:void(0)" class="single-item <?=($key != 0)? 'white-text' : '';?>" id="<?=$job->id?>">
                            <?=$job->title?>
                          </a>
                        </div>

                    <?php endforeach;
                    break;
                
                default:
                    # code...
                    break;
            }
            wp_die();
        }
        function process_get_function_by_sector(){

            $sector_id = $_POST['id'];
            global $wpdb;
            $functions = $wpdb->get_results("SELECT DISTINCT wp_function.id,wp_function.function_title 
                        FROM wp_function
                        INNER JOIN wp_jobs AS wj ON
                        wp_function.id = wj.function_id
                        INNER JOIN wp_sector ON
                        wj.sector_id = wp_sector.id
                        WHERE wj.sector_id = $sector_id AND wj.job_status = 'active' ORDER BY wp_sector.id
                        ");
            
            foreach($functions as $key => $function):?>
             <div class="<?=($key == 0)? 'list_active' : '';?> list-search">
              <a href="javascript:void(0)" class="single-item <?=($key != 0)? 'white-text' : '';?>" id="<?=$function->id?>">
                <?=$function->function_title?>
              </a>
            </div>
            <?php endforeach;
            wp_die();
        }
        
        function process_get_function_by_country(){

            $code = $_POST['id'];
            global $wpdb;
            $functions = $wpdb->get_results("SELECT DISTINCT wp_function.id,wp_function.function_title 
                            FROM wp_function
                            INNER JOIN wp_jobs AS wj ON
                            wp_function.id = wj.function_id
                            WHERE wj.job_country = '".$code."' AND wj.job_status = 'active'
                            ");
            
            foreach($functions as $key => $function):?>
             <div class="<?=($key == 0)? 'list_active' : '';?> list-search">
              <a href="javascript:void(0)" class="single-item <?=($key != 0)? 'white-text' : '';?>" id="<?=$function->id?>">
                <?=$function->function_title?>
              </a>
            </div>
            <?php endforeach;
            wp_die();
        }

        function custom_query_vars_filter($vars) {
          $vars[] = 'by';
          $vars[] = 'job_id';
          $vars[] = 'sector_id';
          $vars[] = 'title_id';
          $vars[] = 'function';
          $vars[] = 'ajp_challenge';
          $vars[] = 'country';
          return $vars;
        }

        public function init_portal_widgets(){
                register_widget( new FirstWidget() );
        }

        function add_menu(){

                $main_page = add_menu_page('Jobs Portal','Jobs Portal','manage_jobs','jobs-portal',
                    array( new adminMenu(), '_renderListPage' ),'',23);

                $sector_page = add_submenu_page( 'jobs-portal', 'Job Sectors', 'Sectors','manage_jobs', 'add-sector', 
                    array( new adminMenu(), '_renderAddSectorPage' )
                    );
                $function_page = add_submenu_page( 'jobs-portal', 'Job Functions', 'Job Functions','manage_jobs', 'add-job-functions', 
                    array( new adminMenu(), '_renderAddfunctionPage' )
                    );
                $job_title_page = add_submenu_page( 'jobs-portal', 'Job Titles', 'Job Titles','manage_jobs', 'add-job-titles', 
                    array( new adminMenu(), '_renderAddTitlePage' )
                    );
                $add_page = add_submenu_page( 'jobs-portal', 'Jobs Portal', 'Add Job','manage_jobs', 'add-job', 
                    array( new adminMenu(), '_renderAddPage' )
                    );

                $job_applications_page = add_submenu_page( 'jobs-portal', 'Job Application List', 'Job Applications','manage_hirings', 'job-applications', 
                    array( new adminMenu(), '_renderJobApplicationsPage' )
                    );
                $applicant_details_page = add_submenu_page( null, '', '','manage_hirings', 'applicant-details', 
                    array( new adminMenu(), '_renderApplicantDetailsPage' )
                    );

                $edit_job_page = add_submenu_page( null, '', '','manage_jobs', 'edit-job', 
                    array( new adminMenu(), '_renderEditJobPage' )
                    );

                $career_registrations = add_submenu_page( 'jobs-portal', 'Career Registrations', 'Talent Registrations',
                    'manage_jobs', 
                    'talent-registrations', 
                    array( new adminMenu(), '_renderTalentRegistrations' )
                    );

                $career_registration_details_page = add_submenu_page( null, '', '','manage_jobs', 'talent-registration-detail', 
                    array( new adminMenu(), '_renderCareerRegistrationDetailsPage' )
                    );

                $delete_job_page = add_submenu_page( null, '', '','manage_jobs', 'delete-job', 
                    array( new adminMenu(), '_renderDeleteJobPage' )
                    );

                $delete_job_application_page = add_submenu_page( null, '', '','manage_jobs', 'delete-job-application', 
                    array( new adminMenu(), '_renderDeleteJobApplicationPage' )
                    );

                // $career_registrations = add_submenu_page( 'jobs-portal', 'Career Registrations', 'Talent Registrations',
                //     'manage_jobs', 
                //     'talent-registrations', 
                //     array( new adminMenu(), '_renderTalentRegistrations' )
                //     );

                // $champions_page = add_submenu_page( 'jobs-portal', 'Champions', 'Champions',
                //     'manage_jobs', 
                //     'champions', 
                //     array( new adminMenu(), '_renderChampions' )
                //     );
                // $positions_page = add_submenu_page( 'jobs-portal', 'Positions', 'Positions',
                //     'manage_jobs', 
                //     'positions', 
                //     array( new adminMenu(), '_renderPositions' )
                //     );

                // $internship_registration_page = add_submenu_page( 'jobs-portal', 'Internship Programme Registrations', 'Internship Programme',
                //     'manage_jobs', 
                //     'internship-registrations', 
                //     array( new adminMenu(), '_renderInternshipRegistrations' )
                //     );

                // $challenges_page = add_submenu_page( 'jobs-portal', 'MAcal Challenges', 'Challenges','manage_jobs', 'challenge-list', 
                //     array( new adminMenu(), '_renderChallengeList' )
                //     );
                // $add_challenge_page = add_submenu_page( 'jobs-portal', 'MAcal Challenges', 'Add Challenge','manage_jobs', 'add-challenge', 
                //     array( new adminMenu(), '_renderChallengeAdd' )
                //     );
                add_action( 'load-' . $edit_job_page, array($this,'load_admin_js') );
                add_action( 'load-' . $applicant_details_page, array($this,'load_admin_js') );
                add_action( 'load-' . $job_applications_page, array($this,'load_admin_js') );
                // add_action( 'load-' . $internship_registration_page, array($this,'load_admin_js') );
                add_action( 'load-' . $job_title_page, array($this,'load_admin_js') );
                add_action( 'load-' . $function_page, array($this,'load_admin_js') );
                add_action( 'load-' . $sector_page, array($this,'load_admin_js') );
                // add_action( 'load-' . $add_challenge_page, array($this,'load_admin_js') );
                // add_action( 'load-' . $challenges_page, array($this,'load_admin_js') );
                add_action( 'load-' . $career_registrations, array($this,'load_admin_js') );
                add_action( 'load-' . $main_page, array($this,'load_admin_js') );
                add_action( 'load-' . $add_page, array($this,'load_admin_js') );
                // add_action( 'load-' . $champions_page, array($this,'load_admin_js') );
                // add_action( 'load-' . $positions_page, array($this,'load_admin_js') );
                add_action( 'load-' . $list_page, array(get_called_class(),'load_admin_js') );
                add_action( 'load-' . $career_registration_details_page, array($this,'load_admin_js') );
        }

        function load_admin_js(){
                add_action( 'admin_enqueue_scripts', array($this,'enqueue_admin_js') );
        }
        function enqueue_admin_js(){
                wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
                wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');

                wp_enqueue_script( 'jquery-cdn', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',array(), '1.9.1', true);
                wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js',array( 'jquery-cdn' ), true);
                wp_enqueue_script( 'custom-js', plugins_url( 'assets/js/custom.js', dirname(__FILE__) ),array( 'jquery-cdn' ));
        }

        function process_career_registration(){

            $file_return = wp_handle_upload( $_FILES['resume'], array('test_form' => false ) );
            global $wpdb;
            $career_registration_table = $wpdb->prefix . 'career_registrations';
            
            $timestamp = date('Y-m-d H:i:s');
            $_POST['talent_network_applicants']['cv_url'] = $file_return['url'];
            $_POST['talent_network_applicants']['created_at'] = $timestamp;
            $_POST['talent_network_applicants']['updated_at'] = $timestamp;

            $wpdb->insert($career_registration_table,$_POST['talent_network_applicants']);
            $applicant_id = $wpdb->insert_id;
            if ($applicant_id) {
                $headers = array();
                $headers['From'] = 'info@simplyintense.com';
                $headers['Content-Type'] = 'text/html';
                $headers['X-PM-Track-Opens'] = true;
                $html_applicant = '
                <div style="max-width:600px;margin:0 auto;background:#fff;">
                    <div style="text-align:center">
                    <img src="'.plugin_dir_url( __DIR__ ).'assets/images/logo.png" alt="icon" style="max-width:100%;margin:0 auto;" />
                    </div>
                    
                        <h3 style="font-size: 24px;color: #003660;margin-bottom: 10px;font-family: sans-serif;">Thank you for joining!</h3>
                        <p style="font-size: 19px;color:#676767;
                            margin-bottom: 0px;font-family: sans-serif;">
                            We\'re always on the lookout for talented people with the right experience. Now that you have joined our Talent Network we can let you know about opportunities that could be a great match for your skills and experience.
                        </p>
                        <br>
                        <p style="font-size: 19px;color:#676767;
                            margin-bottom: 0px;font-family: sans-serif;">
                            Don\'t worry. We\'ll only use your details to contact you about available job opportunities and relevant business updates. But please also keep checking out website for our latest opportunities.
                        </p>
                    </div>';
                    $html_management = '
                     <div style="max-width:600px;margin:0 auto;background:#fff;">
                         <div style="text-align:center">
                        <img src="'.plugin_dir_url( __DIR__ ).'assets/images/logo.png" alt="icon" style="max-width:100%;margin:0 auto;" />
                        </div>
                        <h3 style="font-size: 24px;color: #003660;margin-bottom: 10px;font-family: sans-serif;">Talent Network Registration!</h3>
                        <p style="font-size: 19px;color:#676767;
                            margin-bottom: 0px;font-family: sans-serif;">
                            You have received a Talent Network application for '.$_POST['talent_network_applicants']['first_name'].' '.$_POST['talent_network_applicants']['last_name'].'. Please click on the link to view application.
                        </p>
                        <br><br>
                        <a href="'.site_url().'/wp-admin/admin.php?page=talent-registration-detail&id='.$applicant_id.'" style="color:#f47920;font-size:19px;font-family: sans-serif;">View</a>
                    </div>';
                $response = wp_mail( $_POST['talent_network_applicants']['email'], 'Talent Network Registration', $html_applicant, $headers );
                $response = wp_mail( 'talent.net.hr@mailinator.com', 'Talent Network Registration', $html_management, $headers );
                header('Location:'.get_permalink( get_page_by_path( 'careers/talent-application-thanks' ) ));   
            }

            exit();
        }

        function process_create_challenge(){
            
            global $wpdb;
            $challege_table = $wpdb->prefix . 'challenge';
            $challege_question_table = $wpdb->prefix . 'challenge_question';
            $challege_question_option_table = $wpdb->prefix . 'challenge_question_option';
            $wpdb->insert( 
                $challege_table, 
                array( 
                    'challenge_title' => ($_POST['challenge']) ? $_POST['challenge'] : 'test' ,
                ) 
            );
            $challenge_id = $wpdb->insert_id;

            foreach ($_POST['question'] as $key => $question) {
                $wpdb->insert( 
                    $challege_question_table, 
                    array( 
                        'challenge_id' => $challenge_id,'text' => $question['question']
                    ) 
                );
                $question_id = $wpdb->insert_id;

                foreach ($question['answer'] as $index => $answer) {
                        $wpdb->insert( 
                            $challege_question_option_table, 
                            array( 
                                'challenge_question_id' => $question_id,'option_text' => $answer, 'is_correct' => ($index == $question['is-correct']) ? 1 : 0
                            ) 
                        );        
                      }      
            }
            wp_redirect(admin_url('/admin.php?page=add-challenge', 'http'), 301);
            exit();
        }
        function process_challenge_form(){
            if(isset($_SESSION['ajp_session_data']['ajp_challenge'])){
                $form_completed = true;
                foreach ($_SESSION['ajp_session_data']['ajp_challenge']['questions'] as $key => $question) {
                    if(!array_key_exists('user_answer', $question)){
                        if($question['id'] == $_POST['question_id']){
                            $_SESSION['ajp_session_data']['ajp_challenge']['questions'][$key]['user_answer'] = $_POST['answer'];
                            continue; 
                        }
                        $form_completed = false;
                    }
                    
                }
            }
            if ($form_completed) {
                $correct_answers = 0;
                foreach ($_SESSION['ajp_session_data']['ajp_challenge']['questions'] as $key => $question) {
                    foreach ($question['answers'] as $key => $answer) {
                        if ($answer['id'] == $question['user_answer'] && $answer['is_correct'] == 1) {
                            $correct_answers++;
                        }
                    }
                }
                $_SESSION['ajp_session_data']['ajp_challenge']['results']['correct_answers'] = $correct_answers;
                $_SESSION['ajp_session_data']['ajp_challenge']['results']['total_questions'] = count($_SESSION['ajp_session_data']['ajp_challenge']['questions']);
                $_SESSION['ajp_session_data']['ajp_challenge']['results']['percentage'] = $correct_answers/$_SESSION['ajp_session_data']['ajp_challenge']['results']['total_questions'] * 100;
                if($_SESSION['ajp_session_data']['ajp_challenge']['results']['percentage'] <= 60){
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['title'] = 'We\'re sorry !';
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['pass'] = false;
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['short_message'] = 'You Scored Below Average';
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['message'] = 'Your answers indicate that you may not be a good fit for the Ansa culture. We would like to invite you to take the quiz again or please visit us again in the future.';    
                }
                if($_SESSION['ajp_session_data']['ajp_challenge']['results']['percentage'] >= 60){
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['pass'] = true;
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['title'] = 'Congratulations!';
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['short_message'] = 'we like your answers.';
                    $_SESSION['ajp_session_data']['ajp_challenge']['results']['message'] = 'Your answers indicate that you would make a great addition to our team. We would like to invite you to submit an application by following the link below.';    
                }
                
                
                header('Location:'.get_permalink( get_page_by_path( 'careers/challenges/thanks' ) ));
            }else{

                $permalink = get_permalink( get_page_by_path( 'careers/challenges/list/take' ) );
                $params = array('ajp_challenge' => base64_encode($_SESSION['ajp_session_data']['ajp_challenge']['questions'][0]['challenge_id']) );
                $url = add_query_arg($params,$permalink);
                header('Location:'.$url);   
                
            }
        }
        function process_job_application(){

            $file_return = wp_handle_upload( $_FILES['resume'], array('test_form' => false ) );

            global $wpdb;
            $key_hiring_contact = '';
            $job_applicant_table = $wpdb->prefix.'job_applicants';
            $applicant_work_status_table = $wpdb->prefix.'applicant_work_status';
            $applicant_work_history_table = $wpdb->prefix.'applicant_work_history';
            $applicant_education_history_table = $wpdb->prefix.'applicant_education_history';
            $applicant_additional_info_table = $wpdb->prefix.'applicant_additional_info';
            $job_applicant_requirement_table = $wpdb->prefix.'job_applicant_requirement';
            $job_table = $wpdb->prefix."jobs";
            $job_title_table = $wpdb->prefix."job_title";

            $job_id = $_POST['job_applicants']['job_id'];
            $job = $wpdb->get_row("SELECT * FROM $job_table jt JOIN $job_title_table jtt ON jtt.id = jt.job_title_id WHERE jt.id = $job_id");
            if(!empty($job->key_hiring_contact_id) && $job->key_hiring_contact_id > 0){
                $key_hiring_contact = get_user_by('id', $job->key_hiring_contact_id);
            }

            // JOb applicant data process
            $timestamp = date('Y-m-d H:i:s');
            $_POST['job_applicants']['cv_url'] = $file_return['url'];
            $_POST['job_applicants']['created_at'] = $timestamp;
            $_POST['job_applicants']['updated_at'] = $timestamp;
            $wpdb->insert($job_applicant_table,$_POST['job_applicants']);

            $applicant_id = $wpdb->insert_id;
            if (isset($applicant_id)) {
                
                //Job requirement answers
                foreach ($_POST['job_applicant_requirement'] as $job_req_id => $data) {
                    $req_data['applicant_id'] = $applicant_id;
                    $req_data['job_requirement_id'] = $job_req_id;
                    $req_data['is_check'] = $data;
                    $wpdb->insert($job_applicant_requirement_table,$req_data); 
                }

                // Applicant Work status data process
                $_POST['applicant_work_staus']['applicant_id'] = $applicant_id;
                $other_benefits = '';
                if(isset($_POST['applicant_work_staus']['other_benefits']) && is_array($_POST['applicant_work_staus']['other_benefits'])){
                    $ob_arr = $_POST['applicant_work_staus']['other_benefits'];
                    foreach ($ob_arr as $value) {
                        $other_benefits .= $value.', ';
                    }
                }
                $_POST['applicant_work_staus']['other_benefits'] = $other_benefits;
                $wpdb->insert($applicant_work_status_table,$_POST['applicant_work_staus']);

                //Applicant Work history data process
                $_POST['applicant_work_history']['applicant_id'] = $applicant_id;
                $wpdb->insert($applicant_work_history_table,$_POST['applicant_work_history']);

                // Applicant Additional info Data process
                $_POST['applicant_additional_info']['applicant_id'] = $applicant_id;
                $wpdb->insert($applicant_additional_info_table,$_POST['applicant_additional_info']);

                //Applicant Education history data process
                $_POST['applicant_education_history']['applicant_id'] = $applicant_id;
                $wpdb->insert($applicant_education_history_table,$_POST['applicant_education_history']);                       
        
                $headers = array();
                $headers['From'] = 'info@simplyintense.com';
                $headers['Content-Type'] = 'text/html';
                $headers['X-PM-Track-Opens'] = true;
                $html = '
                <div style="max-width:600px;margin:0 auto;background:#fff;">
                    <div style="text-align:center">
                    <img src="'.plugin_dir_url( __DIR__ ).'assets/images/logo.png" alt="icon" style="max-width:100%;margin:0 auto;" />
                    </div>
                        <h3 style="font-family: sans-serif;font-size: 24px;color: #003660;margin-bottom: 10px;">Thank you for your interest in Massy Group</h3>
                        <p style="font-size: 19px;color:#676767;
                            margin-bottom: 0px;font-family: sans-serif;">A member of our team will be in touch to let you know the outcome.</p>
                </div>
                    ';
                $response = wp_mail( $_POST['job_applicants']['email'], 'Job Application', $html, $headers );

                if(!empty($key_hiring_contact)){
                    $html = '
                    <div style="max-width:600px;margin:0 auto;background:#fff;">
                        <div style="text-align:center">
                        <img src="'.plugin_dir_url( __DIR__ ).'assets/images/logo.png" alt="icon" style="max-width:100%;margin:0 auto;" />
                        </div>

                        <p style="font-size:18px;color:#676767;margin-bottom:30px;max-width: 550px;font-family: sans-serif;">You have recevied an application for '.$job->title.'.</p>
                        <p>
                            <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Name:</span>
                            <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;"> '. $_POST['job_applicants']['first_name'].' '.$_POST['job_applicants']['last_name'].'</span>
                        </p>
                        

                        <p>
                        <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Email:</span>
                        <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;"> '.$_POST['job_applicants']['email'].'</span> 
                        </p>
                        <p>
                            <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Phone:</span>
                            <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;">'.$_POST['job_applicants']['area_code'].' '.$_POST['job_applicants']['phone'].'</span>
                         </p>
                        <p>
                            <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Address: </span>
                            <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;">'.$_POST['job_applicants']['address_line_1'].' '.$_POST['job_applicants']['city'].' '.$_POST['job_applicants']['country'].'</span>
                        </p>
                        <p>
                        <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Residency: </span>
                        <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;">'.$_POST['job_applicants']['citizen'].'</span>
                        </p>
                        <p>
                        <span style="display:inline-block;width:100px;color:#676767;font-family: sans-serif;font-size:18px;">Status: </span>
                        <span style="display:inline-block;color:#676767;font-family: sans-serif;font-size:18px;">'.$_POST['applicant_work_staus']['current_employment_status'].'</span>
                        </p>
                        <p style="color:#676767;font-size:18px;margin-bottom:20px;margin-top:30px;font-family: sans-serif;">Please click on the link to view application.</p>
                        <a href="'.site_url().'/wp-admin/admin.php?page=applicant-details&applicant_id='.$applicant_id.'" style="color:#f47920;font-size:18px;font-family: sans-serif;">View Application</a>
                        </div>
                    ';
                    $response = wp_mail( $key_hiring_contact->user_email, 'Job Application', $html, $headers );
                }      
                header('Location:'.get_permalink( get_page_by_path( 'careers/job-application-thanks' )));   
            }
        }

        public function job_views_counter($job_id){
            global $wpdb;
            $jobs_table = $wpdb->prefix."jobs";
            $wpdb->query("UPDATE $jobs_table SET views = (views + 1) WHERE id = $job_id");
        }
}