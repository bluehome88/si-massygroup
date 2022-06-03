<?php
global $wpdb;
$career_registrations = $wpdb->get_results("SELECT * FROM wp_career_registrations ORDER BY created_at DESC");
?>
<div class="container-fluid">
<div class="row">
  <h2><?php echo get_admin_page_title(); ?>
  <div class="clear"></div>
</div>

    
<div class="row jobsTable">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>Zip Code</th>
            <th>Country</th>
            <th>CV</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($career_registrations as $key => $registration):?>
          <tr>
            <td><?=$registration->first_name?></td>
            <td><?=$registration->last_name?></td>
            <td><?=$registration->email?></td>
            <td><?=$registration->area_code.$registration->phone?></td>
            <td><?=$registration->address_line_1?></td>
            <td><?=$registration->city?></td>
            <td><?=$registration->zip_code?></td>
            <td><?=$registration->country?></td>
            <td>
              <?php if($registration->cv_url):?>
                <a href="<?=$registration->cv_url?>" target="_blank" download>Download</a>
            <?php endif;?>
            </td>
            <td>
              <a href="<?=admin_url()?>admin.php?page=talent-registration-detail&id=<?=$registration->id?>">
               <span class="dashicons dashicons-editor-table"></span>
             </a>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      </div>
    </div>