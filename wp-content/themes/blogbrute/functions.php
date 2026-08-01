<?php
/**
 * Theme functions and definitions
 *
 * @package Blogbrute
 */

if ( ! class_exists( 'BlogBrute_Setup' ) ) {

	class BlogBrute_Setup {

		/**
		 * Constructor.
		 */
		public function __construct() {

			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			add_action( 'after_setup_theme', array( $this, 'theme_mod_filters' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9999 );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		}

		/**
		 * Theme setup.
		 */
		public function theme_setup() {

			$theme = wp_get_theme();

			defined( 'BLOGBRUTE_THEME_DIR' ) || define( 'BLOGBRUTE_THEME_DIR', get_stylesheet_directory() . '/' );
			defined( 'BLOGBRUTE_THEME_URI' ) || define( 'BLOGBRUTE_THEME_URI', get_stylesheet_directory_uri() . '/' );
			defined( 'BLOGBRUTE_THEME_VERSION' ) || define( 'BLOGBRUTE_THEME_VERSION', $theme->get( 'Version' ) );
			defined( 'BLOGBRUTE_THEME_NAME' ) || define( 'BLOGBRUTE_THEME_NAME', $theme->get( 'Name' ) );

			load_theme_textdomain( 'blogbrute', BLOGBRUTE_THEME_DIR . 'languages' );

			require BLOGBRUTE_THEME_DIR . 'font.php';
			require BLOGBRUTE_THEME_DIR . 'customize-options.php';
			require BLOGBRUTE_THEME_DIR . 'hooks/featured-slider-hook.php';
			require BLOGBRUTE_THEME_DIR . 'hooks/header-hooks.php';

			add_theme_support( 'title-tag' );
			add_theme_support( 'automatic-feed-links' );

			add_theme_support( 'custom-background',	
				array(
					'default-color' => '#fff',
					'default-image' => '',
				)
			);

		}

		/**
		 * Theme Mod Defaults.
		 */
		public function theme_mod_filters() {

			add_filter( 'theme_mod_blogarise_global_comment_enable', '__return_false' );
			add_filter( 'theme_mod_blogarise_lite_dark_switcher', '__return_false' );
			
			add_filter( 'theme_mod_blogarise_slider_title_font_size', function() { return 35; }	);

			add_filter(	'theme_mod_blogarise_slider_overlay_color',	function() { return '#00000033'; } );

			add_filter(	'theme_mod_breaking_news_title',	function() { return __('Top Stories','blogbrute') ; } );
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function enqueue_scripts() {

			wp_enqueue_style( 'blogarise-parent-style', get_template_directory_uri() . '/style.css' );
			wp_enqueue_style( 'blogbrute-child-style', get_stylesheet_uri(), array( 'blogarise-parent-style' ), BLOGBRUTE_THEME_VERSION );
			wp_enqueue_style( 'blogbrute-default-css', BLOGBRUTE_THEME_URI . 'assets/css/colors/default.css', array(), BLOGBRUTE_THEME_VERSION );

			if ( is_rtl() ) wp_enqueue_style( 'blogarise-style-rtl', get_template_directory_uri() . '/style-rtl.css', array(), BLOGBRUTE_THEME_VERSION );
			
			wp_enqueue_script( 'blogbrute-custom', BLOGBRUTE_THEME_URI . 'assets/js/custom.js', array( 'jquery' ), BLOGBRUTE_THEME_VERSION, true );

		}

		/**
		 * Register widget areas.
		 */
		public function widgets_init() {

			$footer_columns = absint( get_theme_mod( 'blogarise_footer_column_layout', 3 ) );
			$footer_columns = 12 / max( 1, $footer_columns );

			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar Widget Area', 'blogbrute' ),
					'id'            => 'sidebar-1',
					'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
					'after_title'   => '</h2></div>',
				)
			);

			register_sidebar(
				array(
					'name'          => esc_html__( 'Footer Widget Area', 'blogbrute' ),
					'id'            => 'footer_widget_area',
					'before_widget' => '<div id="%1$s" class="col-md-' . $footer_columns . ' rotateInDownLeft animated bs-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="bs-widget-title"><h2 class="title">',
					'after_title'   => '</h2></div>',
				)
			);

		}

	}

	new BlogBrute_Setup();

}

if( ! function_exists( 'blogarise_footer_copyright' ) ) :
  function blogarise_footer_copyright() { 
    $hide_copyright = esc_attr(get_theme_mod('hide_copyright','true'));
    if ($hide_copyright == true ) { ?>
    <div class="copyright-overlay">
      <div class="container">
        <div class="row">
          <div class="<?php echo ( has_nav_menu( 'footer' ) ? 'col-md-6 text-md-start text-xs' :'col-md-12 text-center' ); ?>">
            <p class="mb-0">
              <?php $blogarise_footer_copyright = get_theme_mod( 'blogarise_footer_copyright','Copyright &copy; All rights reserved' );
                echo '<span class="copyright-text">' . esc_html($blogarise_footer_copyright) .'</span>';
              ?>
              <span class="sep"> | </span>
              <?php  printf(esc_html__('%1$s by %2$s.', 'blogarise'), 'Blogarise', '<a href="https://themeansar.com" target="_blank">Themeansar</a>'); ?>
            </p>
          </div>
          <?php if ( has_nav_menu( 'footer' ) ) {
          echo '<div class="col-md-6 text-md-end text-xs">';
            wp_nav_menu( array(
              'theme_location' => 'footer',
              'container'  => 'nav-collapse collapse navbar-inverse-collapse',
              'menu_class' => 'info-right justify-content-center justify-content-md-end',
              'fallback_cb' => 'blogarise_fallback_page_menu',
              'walker' => new blogarise_nav_walker()
            ) ); 
            
          echo'</div>';
          } ?>
        </div>
      </div>
    </div>
    <?php } 
  }
endif;
add_action( 'blogarise_action_footer_copyright', 'blogarise_footer_copyright' );