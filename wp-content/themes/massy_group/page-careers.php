
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner careerBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">careers with Massy</h2>
      </div>
    </div>
  </div>

  <div class="Career_Section">
    <div class="container">
      <p class="headingText" data-aos="fade-up">
        The Massy Group is one of the most robust, financially stable and progressive institutions in the region , with over 60 companies employing close to 11,000 people. We believe in investing in business and people, in creating an environment for creativity and innovation so that our people can grow and thrive.
      </p>

      <!-- Join netwerk section -->
      <div class="container">
        <div class="JoinUs">
          <div>
            <img src="<?php echo get_template_directory_uri()?>/assets/images/joinusIcon.png" alt="icon" />
          </div>
          <div class="mid">
            <h3>Join Our Talent Network</h3>
            <p>
              Be notified directly when opportunities suited to your skills and
              experience become available.
            </p>
          </div>
          <div>
            <a href="<?=get_permalink(get_page_by_path('careers/join-our-talent-network'))?>">Register Now</a>
          </div>
          <div id="job-search-box"></div>
        </div>
      </div>
      
      <?php
        $_title = $_GET['title'];
        $_country = $_GET['country'];
        $_sector = $_GET['sector'];
        $_function = $_GET['function'];
        $_jobs = $_GET['jobs'];

        global $wp_country;
        $jobs_table = $wpdb->prefix.'jobs';
        $job_title_table = $wpdb->prefix.'job_title';
        $sector_table = $wpdb->prefix."sector";
        $function_table = $wpdb->prefix."function";
        $sectors = $wpdb->get_results("SELECT * FROM $sector_table");
        $functions = $wpdb->get_results("SELECT * FROM $function_table");
      ?>

      <?php if( in_array( 'awsome-jobs-portal/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
        <div class="JobsearchBox" data-aos="fade-up" data-aos-delay="100">
          <h3>Be a part of a better future</h3>
          <div class="d-flex flex-wrap">
            <div class="inputContainer">
              <input name="job_title" id="job-title" type="text" value="<?=$_title?>" placeholder="search for a job" />
              <img onclick="showjobs()" style="cursor: pointer;" src="<?php echo get_template_directory_uri()?>/assets/images/searchicon-colored.png" />
            </div>
            <div class="position-relative selectDrop">
              <select name="job_country" id="job-country" onchange="showjobs()">
                <option value="all">All Countries</option>
                <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                  <option value="<?=$country?>" <?=($_country == $country) ? "selected" : ""?>><?=$country?></option>
                <?php }?>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" />
            </div>
            <div class="position-relative selectDrop">
              <select name="job_sector" id="job-sector" onchange="showjobs()">
                <option value="all">All Sectors</option>
                <?php foreach ($sectors as $key => $sector) {?>
                  <option value="<?=$sector->id?>" <?=($_sector == $sector->id) ? "selected" : ""?>><?=$sector->sector_title?></option>
                <?php }?>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" />
            </div>
            <div class="lastSelect position-relative selectDrop">
              <select name="job_function" id="job-function" onchange="showjobs()">
                <option value="all">All Functions</option>
                <?php foreach ($functions as $key => $function) {?>
                    <option value="<?=$function->id?>" <?=($_function == $function->id) ? "selected" : ""?>><?=$function->function_title?></option>
                <?php }?>
              </select>
              <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" />
            </div>
          </div>
        </div>
      
        <!-- Career Jobs Section -->
        <?php if(!isset($_jobs) && empty($_jobs) && $_jobs == 'search') : ?> 
          <?php get_sidebar('career-jobs-section'); ?>
        <?php else : ?>
          <?php
            $where_clause = ' jobs.job_status = "active"';
            if(isset($_title) && !empty($_title) && $_title != '') { $where_clause .= ' and job_title.title like "%'.$_title.'%"'; }
            if(isset($_country) && !empty($_country) && $_country != 'all') { $where_clause .= ' and jobs.job_country = "'.$_country.'"'; }
            if(isset($_sector) && !empty($_sector) && $_sector != 'all') { $where_clause .= ' and jobs.sector_id = '.$_sector; }
            if(isset($_function) && !empty($_function) && $_function != 'all') { $where_clause .= ' and jobs.function_id = '.$_function; }

            $jobs = $wpdb->get_results("SELECT jobs.*,sector.sector_title,job_title.title FROM $jobs_table AS jobs 
            INNER JOIN $sector_table AS sector ON jobs.sector_id = sector.id
            INNER JOIN $job_title_table AS job_title ON jobs.job_title_id = job_title.id
            INNER JOIN $function_table AS function ON jobs.function_id = function.id
            WHERE $where_clause 
            ORDER BY jobs.created_at DESC");
          ?>
      
          <?php if(count($jobs) > 0): ?>   
            <h3 class="jobOpeningHead">We've <?=count($jobs)?> opening positions for you!!</h3>
            <div class="wrapper text-center">
              <?php foreach ($jobs as $key => $job): ?>
                <a href="<?=get_permalink(get_page_by_path('careers/job-details')).'?job_id='.$job->id ?>" title="<?=$job->title?>">
                  <div class="JobOpeningCard" data-aos="fade-up">
                    <p class="jobDate">to <?=strtoupper(date_format(date_create($job->job_to_date),"M"))?> <?=date_format(date_create($job->job_to_date),"d, Y")?></p>
                    <h4 class="openingTitle">
                      <!-- mb_strimwidth($job->title, 0, 45, "...") -->
                      <?php 
                        if (strlen($job->title) > 45)
                           echo substr($job->title, 0, 45) . ' ...';
                        else
                           echo $job->title;
                      ?>
                    </h4>
                    <p class="jobCateg">
                      <?=$job->sector_title?>
                    </p>
                    <p class="company"><?=$job->job_company?></p>
                    <p class="Joblocation">
                      <img src="<?php echo get_template_directory_uri()?>/assets/images/detailIcon.png" alt="" />
                      <?=$job->job_country?>
                    </p>
                  </div>
                </a>  
              <?php endforeach;?>
            </div>
          <?php else: ?>
              <h3 class="jobOpeningHead">There are no openings at this time</h3>
          <?php endif; ?> 
        <?php endif; ?>
      <?php else: ?>
        <h1 style="font-size: 10vh;text-align: center;margin: 100px 0;color:#f47920;font-weight: 600;">Coming Soon!</h1>
      <?php endif; ?>
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

<script type="text/javascript">

  $(document).ready(function() {
    let queryString = window.location.search;
    if(queryString){
      scrollSmoothTo('job-search-box');
    }
  });

  function scrollSmoothTo(elementId) {
    var element = document.getElementById(elementId);
    element.scrollIntoView({
      block: 'start',
      behavior: 'smooth'
    });
  }
</script>
