<?php
global $wpdb;
$table = $wpdb->prefix."positions";
if ($_POST) {
        
        $wpdb->insert( 
            $table, 
            array( 
                'name' => $_POST['name']
            )  
        );
        ?>
        <div class="updated"><p><strong><?php _e('New Position Added.' ); ?></strong></p></div>
        <?php
         } else {
        //Normal page display
 } 
 $positions = $wpdb->get_results("SELECT * FROM $table");

?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <div class="clear"></div>
</div>

    
	<div class="row">
       <div class="col-sm-6">
	      <form name="jobs_form" method="post" action="">
	      	<input type="text" class="form-control" name="name" value="" placeholder="Enter Position">
	      	<br />
	      	<input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Add Position', 'jobs_trdom' ) ?>" />
	      </form>
	  </div>
      <div class="col-sm-6">
	      <table class="table table-hover table-bordered">
	        <thead>
	          <tr>
	            <th>Position</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php foreach ($positions as $position):?>
	          <tr>
	            <td><?=$position->name?></td>
	            <td><span id="<?=$position->id?>" class="dashicons dashicons-no position_delete"></span></td>
	          </tr>
	          <?php endforeach;?>
	        </tbody>
	      </table>
	  </div>
     </div>
</div>