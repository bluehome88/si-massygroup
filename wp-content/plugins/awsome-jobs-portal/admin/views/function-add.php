<?php
global $wpdb;
$table = $wpdb->prefix."function";
if ($_POST) {
        
        $wpdb->insert( 
            $table, 
            array( 
                'function_title' => $_POST['function_title']
            )  
        );
        ?>
        <div class="updated"><p><strong><?php _e('New Function Added.' ); ?></strong></p></div>
        <?php
         } else {
        //Normal page display
 } 
 $functions = $wpdb->get_results("SELECT * FROM $table");

?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <div class="clear"></div>
</div>

    
	<div class="row jobsTable">
       <div class="col-sm-6">
	      <form name="jobs_form" method="post" action="">
	      	<input type="text" class="form-control" name="function_title" value="" placeholder="Enter Function...">
	      	<input type="submit" class="btn btn-primary" name="Submit" value="<?php _e('Add Function', 'jobs_trdom' ) ?>" />
	      </form>
	  </div>
      <div class="col-sm-6">
	      <table class="table table-hover table-bordered">
	        <thead>
	          <tr>
	            <th>Function Title</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php foreach ($functions as $function):?>
	          <tr>
	            <td><?=$function->function_title?></td>
	            <td><span id="<?=$function->id?>" class="dashicons dashicons-no function_delete"></span></td>
	          </tr>
	          <?php endforeach;?>
	        </tbody>
	      </table>
	  </div>
     </div>
</div>