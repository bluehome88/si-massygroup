
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner careerBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">careers in Massy</h2>
      </div>
      <a href="<?=get_permalink( get_page_by_path( 'careers' ))?>" class="backBtn">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" />BACK TO CAREERS</a
      >
    </div>
  </div>

  <div class="career_form mt-93">
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" id="talent-form" enctype="multipart/form-data" onsubmit="return SubmitForm()">
      <div class="careerFormBox">
        <h4>Talent Network Registration</h4>
        <input type="hidden" name="action" value="career_registration">
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[first_name]" placeholder="First Name" required />
          </div>
          <div>
            <input type="text" name="talent_network_applicants[last_name]" placeholder="Last Name" required />
          </div>
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput col_wrap">
          <div>
            <input type="email" name="talent_network_applicants[email]" placeholder="Email" required />
          </div>
          <div class="d-flex align-items-center area__code">
            <input type="number" name="talent_network_applicants[area_code]" placeholder="Area Code" class="areaCode" required />
            <input type="number" name="talent_network_applicants[phone]" placeholder="Phone Number" required />
          </div>
        </div>
        <div class="nameInput">
          <input type="text" name="talent_network_applicants[address_line_1]" placeholder="Address Line 1" required />
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[city]" placeholder="City" required />
          </div>
          <div>
            <input type="text" name="talent_network_applicants[state]" placeholder="State" />
          </div>
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[zip_code]" placeholder="Zip Code" />
          </div>
          <div>
            <!-- <input type="text" name="talent_network_applicants[country]" placeholder="Country" /> -->
            <select name="talent_network_applicants[country]" required>
              <option value="">Country</option>
              <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                <option value="<?=$country?>" ><?=$country?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div
          class="d-flex align-items-center flex-wrap nameInput selectInput"
        >
          <select name="talent_network_applicants[citizen]" required>
            <option selected disabled>Residency Status</option>
            <option value="Citizen">Citizen</option>
            <option value="Permanent Resident">Permanent Resident</option>
            <option value="Work Permit">Work Permit</option>
          </select>
          <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
        </div>
        <div class="nameInput">
          <textarea name="talent_network_applicants[interest_in_massy]" placeholder="Explain your interest in Massy" required></textarea>
        </div>
        <div class="nameInput">
          <textarea name="talent_network_applicants[additional_info]" placeholder="Additional info" required></textarea>
        </div>
        <label for="resume" class="upload_resume">
          upload resume
        </label>
        <p class="error-msg"></p>
        <input type="file" name="resume" id="resume" class="d-none" />
        <?php echo do_shortcode( '[bws_google_captcha]' ); ?>
      </div>

      <div class="container d-flex justify-content-center" style="margin-bottom: 56px;">
        <input type="submit" class="continue talentSubmit" />
      </div>
    </form>
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>
  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>

<script type="text/javascript">
    function SubmitForm() {
      let flag = true;
      let file = $("#resume");
      if(file.val() == null || file.val() == ""){
        file.addClass("error");
        file.siblings("p").html("Please provide your resume.");
        file.siblings("p").show();
        flag = false;
      }else{
        file.removeClass("error");
        file.siblings("p").hide();
      }

      if(!flag){
        return false;
      }
    }
</script>

