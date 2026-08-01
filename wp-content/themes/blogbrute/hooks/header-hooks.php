<?php

function blogbrute_header_default_section() { ?>
  <!--/header-->
      <header class="bs-default"> 
      <!-- Main Menu Area-->
      <div class="bs-header-main d-none d-lg-block">
        <div class="inner">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-4">
                <?php do_action('blogarise_action_header_social_section'); ?>
              </div>
              <div class="navbar-header col-lg-4">
                <!-- Display the Custom Logo -->
                <div class="site-logo">
                    <?php if(get_theme_mod('custom_logo') !== ""){ the_custom_logo(); } ?>
                </div>
                 <?php do_action('blogarise_action_header_site_title_tagline'); ?>
              </div>
              <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                <!-- Right nav -->
                <div class="info-right right-nav d-flex align-items-center justify-content-end gap-1">
                    <?php blogarise_menu_btns(); ?>
                </div>
                <!-- /Right nav -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Main Menu Area-->
      <div class="bs-menu-full mb-4">
        <div class="container">
          <nav class="navbar navbar-expand-lg navbar-wp"> 
            <!-- Right nav -->
            <div class="m-header align-items-center">
              <!-- navbar-toggle -->
              <button class="navbar-toggler x collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbar-wp" aria-controls="navbar-wp" aria-expanded="false"
                aria-label="Toggle navigation"> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="navbar-header">
                <!-- Display the Custom Logo -->
                <div class="site-logo">
                    <?php if(get_theme_mod('custom_logo') !== ""){ the_custom_logo(); } ?>
                </div>
                <div class="site-branding-text <?php echo esc_attr( display_header_text() ? ' ' : 'd-none'); ?>">
                  <div class="site-title">
                     <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(get_bloginfo( 'name' )); ?></a>
                  </div>
                  <p class="site-description"><?php echo esc_html(get_bloginfo( 'description' )); ?></p>
                </div>
              </div>
                <!-- Right nav -->
              <div class="right-nav"> 
                <?php blogarise_menu_search(); ?>
              </div>
              <!-- /Right nav -->
            </div>
            <!-- Navigation -->
               <div class="collapse navbar-collapse justify-content-lg-center" id="navbar-wp">
                <?php wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'  => 'nav-collapse collapse navbar-inverse-collapse',
                    'menu_class' => 'nav navbar-nav'.(is_rtl() ? ' sm-rtl' :''),
                    'fallback_cb' => 'blogarise_fallback_page_menu',
                    'walker' => new blogarise_nav_walker()
                ) ); ?>
            </div>
          </nav>
        </div>
      </div>
      <!--/main Menu Area-->
    </header>
    <!--/header-->
<?php }

add_action('blogbrute_action_header_type_section', 'blogbrute_header_default_section', 6);