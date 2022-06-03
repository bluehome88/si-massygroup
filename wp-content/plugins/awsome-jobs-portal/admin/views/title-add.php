<?php
global $wpdb;
$table = $wpdb->prefix."job_title";
if ($_POST) {
        
        $wpdb->insert( 
            $table, 
            array( 
                'title' => $_POST['title']
            )  
        );
        ?>
        <div class="updated"><p><strong><?php _e('New Title Added.' ); ?></strong></p></div>
        <?php
         } else {
        //Normal page display
 } 
 $job_titles = $wpdb->get_results("SELECT * FROM $table");

?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <div class="clear"></div>
</div>

    
	<div class="row jobsTable">
       <div class="col-sm-6">
	      <form name="jobs_form" method="post" action="">
	      	<input type="text" class="form-control" name="title" value="" placeholder="Enter Title...">
	      	<input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Add Title', 'jobs_trdom' ) ?>" />
	      </form>
	  </div>
      <div class="col-sm-6">
	      <table class="table table-hover table-bordered">
	        <thead>
	          <tr>
	            <th>Title</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php foreach ($job_titles as $job_title):?>
	          <tr>
	            <td><?=$job_title->title?></td>
	            <td><span id="<?=$job_title->id?>" class="dashicons dashicons-no title_delete"></span></td>
	          </tr>
	          <?php endforeach;?>
	        </tbody>
	      </table>
	  </div>
     </div>
</div>