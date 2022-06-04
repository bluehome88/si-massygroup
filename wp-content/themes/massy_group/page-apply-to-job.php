
<?php get_header(); ?>

<?php

$job_id = get_query_var('job_id');
$job_table = $wpdb->prefix."jobs";
$job_title_table = $wpdb->prefix."job_title";
$job_requirement_table = $wpdb->prefix."job_requirements";

$job = $wpdb->get_row("SELECT jt.*, jtt.title FROM $job_table jt JOIN $job_title_table jtt ON jtt.id = jt.job_title_id WHERE jt.id = $job_id");
$job_requirements = $wpdb->get_results("SELECT * FROM $job_requirement_table WHERE job_id = $job->id");

?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner careerBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">careers in Massy</h2>
      </div>
    </div>
  </div>

  <div class="career_form">
    <h3 class="jobOpeningHead mt-93">
      <?=$job->title?>
    </h3>
    <div class="careerFormBox">
      <h4>Apply to job</h4>
      <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" id="jobForm" enctype="multipart/form-data">
        <input type="hidden" name="action" value="job_application">
        <input type="hidden" name="job_applicants[job_id]" value="<?=$job_id?>">
        <!-- 0 -->
         <div class="tab" id="step0">
          <h3>Position: <?=$job->title?></h3>
          <?php if(!empty($job_requirements)): ?>
            <?php foreach($job_requirements as $req):?>
              <div class="d-flex justify-content-between align-items-start">
                <label>- <?=stripslashes($req->req_text)?></label>
                <div>
                  <label class="d-inline-flex align-items-center">
                    <input type="radio" name="job_applicant_requirement[<?=$req->id?>]" value="1" checked>
                    Yes
                  </label>
                  <label class="d-inline-flex align-items-center">
                  <input type="radio" name="job_applicant_requirement[<?=$req->id?>]" value="0">  
                    No
                  </label>
                </div>
              </div>
            <?php endforeach;?>
          <?php endif;?>
        </div>
        <!-- 1 -->
        <div class="tab">
          <div class="d-flex align-items-start flex-wrap nameInput">
            <div>
              <input type="text" name="job_applicants[first_name]" id="ja-first-name" placeholder="First Name"  />
              <p id="ja-first-name-error" class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="job_applicants[last_name]" id="ja-last-name" placeholder="Last Name" />
              <p id="ja-last-name-error" class="error-msg"></p>
            </div>
          </div>
          <div
            class="d-flex align-items-start flex-wrap nameInput col_wrap"
          >
            <div>
              <input type="text" name="job_applicants[email]" id="ja-email" placeholder="Email" />
              <p id="ja-email-error" class="error-msg"></p>
            </div>
            <div class="d-flex align-items-start area__code">
              <div>
                <input
                  type="number"
                  name="job_applicants[area_code]"
                  id="ja-area-code"
                  placeholder="Area Code"
                  class="areaCode"
            
                />
                <p id="ja-area-code-error" class="error-msg areaCode"></p>
              </div>
              <div style="flex: 1;">
                <input type="number" name="job_applicants[phone]" id="ja-phone" placeholder="Phone Number" />
                <p id="ja-phone-error" class="error-msg" style="text-align: right;"></p>
              </div>
              
              
            </div>
          </div>
          <div class="nameInput">
            <input type="text" name="job_applicants[address_line_1]" id="ja-address-line-1" placeholder="Address Line 1" />
            <p id="ja-address-line-1-error" class="error-msg"></p>
          </div>
          <div class="d-flex align-items-start flex-wrap nameInput">
            <div>
              <input type="text" name="job_applicants[city]" id="ja-city" placeholder="City" />
              <p id="ja-city-error" class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="job_applicants[state]" id="ja-state" placeholder="State" />
              <p id="ja-state-error" class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-start flex-wrap nameInput">
            <div>
              <input type="text" name="job_applicants[zip_code]" id="ja-zip-code" placeholder="Zip Code" />
              <p id="ja-zip-code-error" class="error-msg"></p>
            </div>
            <div>
              <!-- <input type="text" name="job_applicants[country]" placeholder="Country" /> -->
              <select name="job_applicants[country]" id="ja-country">
                <option selected disabled>Country</option>
                <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                  <option value="<?=$country?>" ><?=$country?></option>
                <?php }?>
              </select>
              <p id="ja-country-error" class="error-msg"></p>
            </div>
          </div>
          <div
            class="d-flex align-items-start flex-wrap nameInput selectInput"
          >
            <select name="job_applicants[citizen]" id="ja-citizen">
              <option selected disabled>Residency Status</option>
              <option value="Citizen">Citizen</option>
              <option value="Permanent Resident">Permanent Resident</option>
              <option value="Work Permit">Work Permit</option>
            </select>
            <p id="ja-citizen-error" class="error-msg"></p>
            <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
          </div>
        </div>
        <!-- 2 -->
        <div class="tab">
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <div class="input-group" >
                <input
                  type="text"
                  name="applicant_work_staus[available_start_date]"
                  id="aws-available-start-date"
                  placeholder="Available start date"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="aws-available-start-date-error" class="error-msg"></p>
            </div>
            <div class="selectInput">
              <select name="applicant_work_staus[current_employment_status]" id="aws-current-employment-status">
                <option selected disabled>Current Employment status</option>
                <option value="Employed">Employed</option>
                <option value="Self Employed">Self Employed</option>
                <option value="Unemployed">Unemployed</option>
                <option value="Student">Student</option>
              </select>
              <p class="error-msg"></p>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
            </div>
          </div>
          <div
            class="d-flex align-items-center flex-wrap nameInput col_wrap"
          >
            <div class="selectInput">
              <select name="applicant_work_staus[past_massy_employee]" id="aws-past-massy-employee">
                <option selected disabled
                  >Have you ever worked for the Massy Group</option
                >
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <p class="error-msg"></p>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <h6 class="mr-5 text-white">If Yes when and where?</h6>
            <div>
              <input type="text" name="applicant_work_staus[past_massy_city]" id="aws-past-massy-city" placeholder="City" />
              <p class="error-msg"></p>
            </div>
            <div>
              <div class="input-group">
                <input
                  type="text"
                  name="applicant_work_staus[past_massy_date]"
                  id="aws-past-massy-date"
                  placeholder="Date"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="aws-past-massy-date-error" class="error-msg"></p>
              <!-- <input type="text" placeholder="date" /> -->
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput checkbox-inputs d-flex flex-wrap justify-content-between">
              <!-- <select name="applicant_work_staus[other_benefits]" id="aws-other-benefits">
                <option selected disabled>Other Benefits</option>
                <option value="Car/Car Allowance">Car/Car Allowance</option>
                <option value="Housing Allowance">Housing Allowance</option>
                <option value="Incentives/Bonus">Incentives/Bonus</option>
              </select>
              <p class="error-msg"></p>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" /> -->
              <h6 class="mr-5 text-white">Other Benefits</h6>
              <label for="aws-other-benefits-1" class="text-white">
                <input type="checkbox" name="applicant_work_staus[other_benefits][]" id="aws-other-benefits-1" value="Car/Car Allowance">
                Car/Car Allowance
              </label>
              <label for="aws-other-benefits-2" class="text-white">
                <input type="checkbox" name="applicant_work_staus[other_benefits][]" id="aws-other-benefits-2" value="Housing Allowance">
                Housing Allowance
              </label>
              <label for="aws-other-benefits-3" class="text-white">
                <input type="checkbox" name="applicant_work_staus[other_benefits][]" id="aws-other-benefits-3" value="Incentives/Bonus">
                Incentives/Bonus
              </label>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="number" name="applicant_work_staus[current_base_salary]" id="aws-current-base-salary" placeholder="Current Base Salary ($TTD)" />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="number" name="applicant_work_staus[incentive_earned_last_year]" id="aws-incentive-earned-last-year" placeholder="Incentive earned last year ($TTD)" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="number" name="applicant_work_staus[value_of_other_benefits]" id="aws-value-of-other-benefits" placeholder="Value of other benefits ($TTD)" />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="number" name="applicant_work_staus[tcc]" id="aws-tcc" placeholder="Total Cash Compensation ($TTD)" />
              <p class="error-msg"></p>
            </div>
          </div>
        </div>
        <!-- 3 -->
        <div class="tab">
          <h6 class="mt-3 text-white">WORK HISTORY: Current and previous 2 employers (most currently listed first)</h6>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input type="text" name="applicant_work_history[employer_name]" id="awh-employer-name" placeholder="Employer's Name" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="text" name="applicant_work_history[employer_city]" id="awh-employer-city" placeholder="City" />
              <p class="error-msg"></p>
            </div>
            <div class="selectInput">
              <select name="applicant_work_history[employer_country]" id="awh-employer-country">
                <option selected disabled>Country</option>
                <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                  <option value="<?=$country?>" ><?=$country?></option>
                <?php }?>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="text" name="applicant_work_history[position_held]" id="awh-position-held" placeholder="Position Held" />
              <p class="error-msg"></p>
            </div>
            <div>
              <div class="input-group">
                <input
                  type="text"
                  name="applicant_work_history[start_date]"
                  id="awh-start-date"
                  placeholder="Start Date"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="awh-start-date-error-msg" class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <div id="awh-currently-employed-block">
                <label for="awh-currently-employed" class="text-white">
                  <input type="checkbox" name="applicant_work_history[currently_employed]" id="awh-currently-employed" checked value="1" onchange="showAwhFinishDate()">
                  Currently Employed
                </label>
              </div>
              
              <div class="input-group" id="awh-finish-date-block" style="display: none;">
                <input
                  type="text"
                  name="applicant_work_history[finish_date]"
                  id="awh-finish-date"
                  placeholder="Date Finished"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="awh-finish-date-error-msg" class="error-msg"></p>
            </div>
          </div>
          <div class="nameInput">
              <textarea name="applicant_work_history[duties]" id="awh-duties" placeholder="Describe Your Duties"></textarea>
              <p class="error-msg"></p>
          </div>
          <div class="nameInput">
            <textarea name="applicant_work_history[reason_for_leaving]" id="awh-reason-for-leaving" placeholder="Reason for Leaving (if no longer employed there)"></textarea>
            <p class="error-msg"></p>
          </div>
        </div>
        <!-- 4 -->
        <div class="tab">
          <h6 class="mt-3 text-white">WORK HISTORY: Current and previous 2 employers (most currently listed first)</h6>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input type="text" name="applicant_work_history[employer_name_additional]" id="awh-employer-name-additional" placeholder="Employer's Name" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="text" name="applicant_work_history[employer_city_additional]" id="awh-employer-city-additional" placeholder="City" />
              <p class="error-msg"></p>
            </div>
            <div class="selectInput">
              <select name="applicant_work_history[employer_country_additional]" id="awh-employer-country-additional">
                <option selected disabled>Country</option>
                <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                  <option value="<?=$country?>" ><?=$country?></option>
                <?php }?>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <input type="text" name="applicant_work_history[position_held_additional]" id="awh-position-held-additional" placeholder="Position Held" />
              <p class="error-msg"></p>
            </div>
            <div>
              <div class="input-group">
                <input
                  type="text"
                  name="applicant_work_history[start_date_additional]"
                  id="awh-start-date-additional"
                  placeholder="Start Date"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="awh-start-date-additional-error-msg" class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div>
              <div class="input-group">
                <input
                  type="text"
                  name="applicant_work_history[finish_date_additional]"
                  id="awh-finish-date-additional"
                  placeholder="Date Finished"
                  data-toggle="datepicker"
                />
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
              <p id="awh-finish-date-additional-error-msg" class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-start flex-wrap nameInput col_wrap">
            <div class="d-flex align-items-start area__code">
              <div>
                <input
                  type="number"
                  name="applicant_work_history[employer_area_code]"
                  id="awh-employer-area-code"
                  placeholder="Area Code"
                  class="areaCode"
                />
                <p id="awh-employer-area-code-error" class="error-msg areaCode"></p>
              </div>
              <div style="flex: 1;">
                <input type="number" name="applicant_work_history[employer_phone]" id="awh-employer-phone" placeholder="Employer Phone Number" />
                <p id="awh-employer-phone-error" class="error-msg" style="text-align: right;"></p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-start flex-wrap nameInput">
            <div>
              <input type="text" name="applicant_work_history[supervisor_first_name]" id="awh-supervisor-first-name" placeholder="Supervisor First Name" />
              <p id="awh-first-name-error" class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="applicant_work_history[supervisor_last_name]" id="awh-supervisor-last-name" placeholder="Supervisor Last Name" />
              <p id="awh-last-name-error" class="error-msg"></p>
            </div>
          </div>
          <div class="nameInput">
            <textarea name="applicant_work_history[duties_additional]" id="awh-duties-additional" placeholder="Describe Your Duties"></textarea>
            <p class="error-msg"></p>
          </div>
          <div class="nameInput">
            <textarea name="applicant_work_history[reason_for_leaving_additional]" id="awh-reason-for-leaving-additional" placeholder="Reason for Leaving (if no longer employed there)"></textarea>
            <p class="error-msg"></p>
          </div>
        </div>
        <!-- 5 -->
        <div class="tab">
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_additional_info[criminal_offender]" id="aai-criminal-offender">
                <option selected disabled
                  >Have you ever been convicted of a criminal
                  offense?</option
                >
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="nameInput">
            <textarea name="applicant_additional_info[offence_reasons]" id="aai-offence-reasons" placeholder="If yes please give date and explain"></textarea>
            <p class="error-msg"></p>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_additional_info[employed_under_other_name]" id="aai-employed-under-other-name">
                <option selected disabled
                  >Have you ever been employed under a name other than the name used on this application?</option
                >
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="nameInput">
            <textarea name="applicant_additional_info[reason_for_leaving]" id="aai-reason-for-leaving" placeholder="Reason for leaving (if no longer employed there)"></textarea>
            <p class="error-msg"></p>
          </div>
        </div>
        <!-- 6 -->
        <div class="tab">
          <h6 class="mt-3 text-white">EDUCATION INFORMATION / HIGH SCHOOL</h6>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input
                type="text"
                name="applicant_education_history[school_name]" 
                id="aeh-school-name"
                placeholder="Name/City/State of High School"
              />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="applicant_education_history[school_degree]" id="aeh-school-degree" placeholder="Course of Study" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_education_history[school_graduated]" id="aeh-school-graduated">
                <option selected disabled>Did you graduate?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="attending">Attending</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <h6 class="mt-3 text-center text-white">College or University</h6>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input
                type="text"
                name="applicant_education_history[college_name]"
                id="aeh-college-name"
                placeholder="Name/City/State of College or University"
              />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="applicant_education_history[college_degree]" id="aeh-college-degree" placeholder="Course of Study" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_education_history[college_graduated]" id="aeh-college-graduated">
                <option selected disabled>Did you graduate?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="attending">Attending</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
        </div>
        <!-- 7 -->
        <div class="tab">
          <h6 class="mt-3 text-white">OTHER</h6>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input
                type="text"
                name="applicant_education_history[school_name_additional]"
                id="aeh-school-name-additional"
                placeholder="Name/City/State of High School"
              />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="applicant_education_history[school_degree_additional]" id="aeh-school-degree-additional" placeholder="Course of Study" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_education_history[school_graduated_additional]" id="aeh-school-graduated-additional">
                <option selected disabled>Did you graduate?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="attending">Attending</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="nameInput">
            <textarea name="job_applicants[covering_letter]" id="ja-covering_letter" placeholder="Covering letter"></textarea>
            <p class="error-msg"></p>
          </div>
          <label for="resume" class="upload_resume">
            upload resume
          </label>
          <input type="file" name="resume" id="resume" class="d-none">
          <!-- <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <input
                type="text"
                name="applicant_education_history[college_name_additional]"
                id="aeh-college-name-additional"
                placeholder="Name/City/State of College or University"
              />
              <p class="error-msg"></p>
            </div>
            <div>
              <input type="text" name="applicant_education_history[college_degree_additional]" id="aeh-college-degree-additional" placeholder="Course of Study" />
              <p class="error-msg"></p>
            </div>
          </div>
          <div class="d-flex align-items-center flex-wrap nameInput">
            <div class="selectInput">
              <select name="applicant_education_history[college_graduated_additional]" id="aeh-college-graduated-additional">
                <option selected disabled>Did you graduate?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
              <p class="error-msg"></p>
            </div>
          </div> -->
          <div class="g-recaptcha" data-sitekey="6LeUfQcaAAAAAAES6R7TrqI7f8BKt35hHVgDZwq_" data-callback="recaptchaCallback"></div>
          <div id="recaptcha_error" style="display:none;color: red;background: white;margin: 10px 0;padding: 10px;border: 1px solid;border-radius: 10px;">Please complete the Re-captcha authentication to submit the form.</div>
        </div>
      </form>
    </div>

    <div class="container">
      <div class="next_prev_btn">
        <button type="submit" class="prevBtn" onclick="nextPrev(-1)">
          BACK
        </button>
        <button type="submit" class="continue" onclick="nextPrev(1)">
          CONTINUE
        </button>
      </div>
      <p class="step"></p>
    </div>
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>
  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>



<?php get_footer(); ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
  /* ====================== 
      step form script
  =========================*/

  var currentTab = 0;
  showTab(currentTab);
  // if($('#step0.active__tab')){
  //     $('.step').hide();
  //     document.querySelector('.continue').innerHTML = 'Start Application';
  //     document.querySelector('.continue').setAttribute('onclick', 'nextPrev(0)');
  // }else{
  //   $('.step').show();
  // }

  function showTab(n) {
    console.log("current tab - "+n);
    var x = document.getElementsByClassName('tab');
    x[n].classList.add('active__tab');
    if (n == 0) {
      document.querySelector('.prevBtn').style.display = 'none';
      $('.step').hide();
      document.querySelector('.continue').innerHTML = 'Start Application';
      document.querySelector('.continue').setAttribute('onclick', 'nextPrev(0)');
      document.querySelector('.continue').style.marginBottom= "50px";

    } else {
      document.querySelector('.prevBtn').style.display = 'inline';
      $('.step').show();
      document.querySelector('.continue').innerHTML = 'Continue';
      document.querySelector('.continue').setAttribute('onclick', 'nextPrev(1)');
    }
    if (n == x.length - 1) {
      document.querySelector('.continue').innerHTML = 'Submit';
      document.querySelector('.continue').removeAttribute('onclick');
      document.querySelector('.continue').setAttribute('onclick', 'SubmitForm(event)');
      // document.querySelector('.continue').disabled = true;
      // if(grecaptcha.getResponse().length !== 0){
      //   document.querySelector('.continue').disabled = false;
      // }
    } else {
      document.querySelector('.continue').innerHTML = 'Continue';
      document.querySelector('.continue').setAttribute('onclick', 'nextPrev(1)');
      if(n == 0){
        document.querySelector('.continue').innerHTML = 'Start Application';
        document.querySelector('.continue').setAttribute('onclick', 'nextPrev(0)');
        document.querySelector('.continue').style.marginBottom= "50px";
      }
    }
    const index = n + 1;
    $('.step').text('step ' + (index - 1) + ' / ' + (x.length - 1));
  }

  function nextPrev(n) {
    document.querySelector('.continue').disabled = false;
    var x = document.getElementsByClassName('tab');
    console.log(n);
    if(n == 1){
      if (!validateForm(currentTab)) return false;
    }

    // if (currentTab >= x.length) {
    //   //...the form gets submitted:
    //   document.getElementById('jobForm').submit();
    //   return false;
    // }
    x[currentTab].classList.remove('active__tab');
    if(n == 0){
      currentTab = currentTab + 1;
    }else{
      currentTab = currentTab + n;
    }
    showTab(currentTab);
  }

  // $('.date').datepicker({
  //   autoclose: false,
  // });
  $('[data-toggle="datepicker"]').datepicker({
    autoHide: true,
    format: 'yyyy-mm-dd'
  });

  function showAwhFinishDate(){
    $("#awh-currently-employed-block").hide();
    $("#awh-finish-date-block").show();
  }

  function recaptchaCallback() {
    document.querySelector('.continue').disabled = false;
  };

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  if(urlParams.has('job_id')){
    let jID = urlParams.get('job_id');
    if(jID) {}else{window.location.href = window.location.origin+"/careers";}
  }else{
    window.location.href = window.location.origin+"/careers";
  }
</script>
