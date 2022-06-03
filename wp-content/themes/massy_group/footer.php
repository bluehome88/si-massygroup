<?php

?>
	<footer>
      <div class="container">
        <div class="footerInner">
          <div class="row">
            <div class="col-md-3 first_col mb-3">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="logo" />
              <p>Email: <a href="mailto:info@massygroup.com">info@massygroup.com</a></p>
              <p>Trinidad & Tobago: 1 868 625 3433</p>
              <p>Barbados: 1 246 417 5110</p>
              <!-- Stock Data Section -->
              <?php get_sidebar('footer-stock-data-section'); ?>
              <a href="https://www.facebook.com/MassyGroup" class="social_icon"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="https://www.youtube.com/user/NealandMassyGroup/featured?disable_polymer=1" class="social_icon"><i class="fab fa-youtube"></i></a>
              <a href="https://www.linkedin.com/company/massy-group-of-companies" class="social_icon"
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
            <?=custom_footer_menu();?>
          </div>
        </div>
      </div>
      <div class="secFooter">
        <p class="Cpyright">
          All contents &copy; Copyright Massy Group, Inc, 1997-<?=date('Y')?>.All Rights
          Reserved
        </p>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
