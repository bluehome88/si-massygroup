<?php
namespace AwsomeJobPortal\Widgets;

class MyWidget extends \WP_Widget{
	function __construct() {
		parent::__construct(
			'wpb_widget', 
			__('Latest Jobs widget', 'wpb_widget_domain'), 
			array( 'description' => __( 'Latest jobs widget', 'wpb_widget_domain' ), ) 
			);
	}

	// Creating widget front-end

	public function widget( $args, $instance ) {

		// echo $args['before_widget'];
		global $wpdb;
		$jobs_table = $wpdb->prefix.'jobs';
		$sector_table = $wpdb->prefix.'sector';
		$job_title_table = $wpdb->prefix.'job_title';
		$jobs = $wpdb->get_results("SELECT jobs.*,sector.sector_title,job_title.title FROM $jobs_table AS jobs 
        INNER JOIN $sector_table AS sector ON jobs.sector_id = sector.id
        INNER JOIN $job_title_table AS job_title ON jobs.job_title_id = job_title.id
        WHERE jobs.job_status = 'active' ORDER BY jobs.created_at DESC");
		?>
		
		<?php if(count($jobs) > 0): ?>   
        <h3 class="jobOpeningHead">We've <?=count($jobs)?> opening positions for you!!</h3>
	    <div class="wrapper text-center">
	    	<?php
	    	foreach ($jobs as $key => $job): ?>
	    		<a href="<?=get_permalink(get_page_by_path('careers/job-details')).'?job_id='.$job->id ?>" title="<?=$job->title?>">
			        <div class="JobOpeningCard" data-aos="fade-up">
			          <p class="jobDate">to <?=strtoupper(date_format(date_create($job->job_to_date),"M"))?> <?=date_format(date_create($job->job_to_date),"d, Y")?></p>
			          <h4 class="openingTitle">
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
		        <?php 
	    	endforeach;?>
	    </div>
	    <?php else: ?>
	    	<h3 class="jobOpeningHead">There are no openings at this time</h3>
	    <?php endif; ?> 
       
		<?php 
		// echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		return $instance;
	}
}