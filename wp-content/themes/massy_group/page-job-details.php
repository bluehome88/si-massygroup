
<?php get_header(); ?>

<?php

$job_id = get_query_var('job_id');
global $wpdb;
$jobs_table = $wpdb->prefix.'jobs';
$sector_table = $wpdb->prefix.'sector';
$job_title_table = $wpdb->prefix.'job_title';
$job = $wpdb->get_results("SELECT jobs.*,sector.sector_title,job_title.title FROM $jobs_table AS jobs 
    INNER JOIN $sector_table AS sector ON jobs.sector_id = sector.id
    INNER JOIN $job_title_table AS job_title ON jobs.job_title_id = job_title.id
    WHERE jobs.job_status = 'active' AND jobs.id = $job_id");
// print '<pre>';
// print_r($job);
// print '</pre>';
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
      <a href="<?php echo get_permalink( get_page_by_path('careers') ); ?>" class="backBtn">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" /> BACK TO CAREERS</a
      >
    </div>
  </div>

  <!-- news article section -->
  <div class="newsArticle">
    <div class="container">
      <div class="newsDate">
        <p class="date">TO <span><?=strtoupper(date_format(date_create($job[0]->job_to_date),"M"))?> <?=date_format(date_create($job[0]->job_to_date),"d, Y")?></span></p>
      </div>
      <h4 class="openingTitle">
        <?=$job[0]->title?>
      </h4>
      <p class="jobCateg">
        <?=$job[0]->sector_title?>
      </p>
      <p class="company"><?=$job[0]->job_company?></p>
      <p class="Joblocation">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/detailIcon.png" alt="" />
        <?=$job[0]->job_country?>
      </p>
      <div class="aboutTextWrapper p-0 mt-5">
        <?=apply_filters( 'the_content', $job[0]->job_description )?>
      </div>
      <div class="text-center">
        <a href="<?=get_permalink(get_page_by_path('careers/apply-to-job')).'?job_id='.$job[0]->id ?>" class="backBtn margin_top"> APPLY TO JOB</a>
      </div>
    </div>
  </div>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>

  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- career section -->
  <?php get_sidebar('career-opportunities'); ?>
</main>

<?php get_footer(); ?>
