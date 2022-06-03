<?php
global $wpdb;
if ($_POST) {
		$file_return = wp_handle_upload( $_FILES['sector_icon'], array('test_form' => false ) );
        $table = $wpdb->prefix."sector";
        $wpdb->insert( 
            $table, 
            array( 
                'sector_title' => $_POST['sector_title'],
                'sector_icon'  => $file_return['url']
            )  
        );
        ?>
        <div class="updated"><p><strong><?php _e('New sector.' ); ?></strong></p></div>
        <?php
         } else {
        //Normal page display
 } 
 $sectors = $wpdb->get_results("SELECT * FROM wp_sector");

?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <div class="clear"></div>
</div>

    
	<div class="row jobsTable">
       <div class="col-sm-6">
	      <form name="jobs_form" method="post" action="" enctype="multipart/form-data">
	      	<div class="row">
	      		<div class="col-md-6">
	      			<input type="text" class="form-control" name="sector_title" value="" placeholder="Enter Sector">
	      		</div>
	      		<!-- <div class="col-md-6">
	      			<input type="file" name="sector_icon" value="">
	      		</div> -->
	      	</div>
	      	<br />
	      	<div class="row">
	      		<div class="col-md-6">
	      			<input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Add Sector', 'jobs_trdom' ) ?>" />	
	      		</div>
	      	</div>
	      	
	      	
	      </form>
	  </div>
      <div class="col-sm-6">
	      <table class="table table-hover table-bordered">
	        <thead>
	          <tr>
	            <th>Sector Title</th>
	            <!-- <th>Sector Icon</th> -->
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php foreach ($sectors as $sector):?>
	          <tr>
	            <td><?=$sector->sector_title?></td>
	            <!-- <td><img src="<?php //the_field('logo',354);?>" srcset="<?= $sector->sector_icon?>" alt="Logo"></td> -->
	            <td><span id="<?=$sector->id?>" class="dashicons dashicons-no sector_delete"></span></td>
	          </tr>
	          <?php endforeach;?>
	        </tbody>
	      </table>
	  </div>
     </div>
</div>