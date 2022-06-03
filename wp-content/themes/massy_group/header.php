<?php

?><!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TS9DBX4');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head();?>
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TS9DBX4"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Header section -->
    <header class="d-flex align-items-center">
      <div class="container header-left" style="margin-left: 120px;">
        <div
          class="headerInner d-flex align-items-center justify-content-between"
        >
          <div class="logo">
            <a href="<?php echo site_url(''); ?>">
              <img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="Massy Group Logo" />
            </a>
          </div>
          <div class="menuBTN">
            <div class="menu-btn__burger"></div>
          </div>
          <div class="navigation">
            <?=custom_header_menu();?>
            <div class="social social-sm mr-3">
              <a href="https://www.facebook.com/MassyGroup">
                <i class="fab fa-facebook-f facebook"></i>
              </a>
              <a href="https://www.linkedin.com/company/massy-group-of-companies">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
          <div class="social social-lg">
            <a href="https://www.facebook.com/MassyGroup">
              <i class="fab fa-facebook-f facebook"></i>
            </a>
            <a href="https://www.linkedin.com/company/massy-group-of-companies">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="searchbar">
        <div class="textinput">
          <?php get_search_form(); ?>
          <!-- <input type="search" placeholder="search" class="header_search" /> -->
          <button class="searchToggle">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/search-icon.png" />
          </button>
        </div>
      </div>
    </header>
