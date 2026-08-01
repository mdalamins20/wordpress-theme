<?php
/**
 * Vyro Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vyro Blog
 */

if ( ! defined( 'VYRO_BLOG_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'VYRO_BLOG_VERSION', '1.0.6' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vyro_blog_setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on vyro-blog, use a find and replace
	* to change 'vyro-blog' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'vyro-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'register_block_style' );

	add_theme_support( 'register_block_pattern' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	// add woocommerce support.
	add_theme_support( 'woocommerce' );

	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'vyro-blog' ),
			'social'  => esc_html__( 'Social Menu', 'vyro-blog' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'vyro_blog_custom_background_args',
			array(
				'default-color' => 'f9f3ee',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	* Add support for core custom logo.
	*
	*@link https://codex.wordpress.org/Theme_Logo
	*/
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'vyro_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vyro_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vyro_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'vyro_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vyro_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'vyro-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vyro-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Regsiter 3 above footer widgets.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Above Footer Widget', 'vyro-blog' ),
			'id'            => 'above-footer-widget',
			'description'   => esc_html__( 'Add widgets here.', 'vyro-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Regsiter 4 footer widgets.
	register_sidebars(
		4,
		array(
			/* translators: %d: Footer Widget count. */
			'name'          => esc_html__( 'Footer Widget %d', 'vyro-blog' ),
			'id'            => 'footer-widget',
			'description'   => esc_html__( 'Add widgets here.', 'vyro-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'vyro_blog_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function vyro_blog_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';


	// Slick style.
	wp_enqueue_style( 'vyro-blog-slick-css', get_template_directory_uri() . '/assets/css/slick' . $min . '.css', array(), '1.8.0' );

	// Fontawesome style.
	wp_enqueue_style( 'vyro-blog-font-awesome-css', get_template_directory_uri() . '/assets/css/all' . $min . '.css', array(), '7.2.0' );

	// Google fonts.
	wp_enqueue_style( 'vyro-blog-google-fonts', wptt_get_webfont_url( vyro_blog_get_fonts_url() ), array(), null );
	wp_enqueue_style( 'vyro-blog-bengali-font', 'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap', array(), null );

	// Main style.
	wp_enqueue_style( 'vyro-blog-style', get_template_directory_uri() . '/style.css', array(), VYRO_BLOG_VERSION );

	// Navigation script.
	wp_enqueue_script( 'vyro-blog-navigation', get_template_directory_uri() . '/assets/js/navigation' . $min . '.js', array(), VYRO_BLOG_VERSION, true );

	wp_enqueue_script( 'vyro-blog-slick-js', get_template_directory_uri() . '/assets/js/slick' . $min . '.js', array( 'jquery' ), '1.8.0', true );

	// Custom script.
	wp_enqueue_script( 'vyro-blog-custom-script', get_template_directory_uri() . '/assets/js/custom' . $min . '.js', array( 'jquery' ), VYRO_BLOG_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vyro_blog_scripts' );

/**
* Include wptt webfont loader.
*/
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Functions which enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Google Fonts
*/
require get_template_directory() . '/inc/google-fonts.php';

/**
* Dynamic CSS
*/
require get_template_directory() . '/inc/dynamic-css.php';

/**
* Breadcrumb
*/
require get_template_directory() . '/inc/class-breadcrumb-trail.php';

/**
* Recommended Plugins
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
* Widgets.
*/
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Category color.
 */
require get_template_directory() . '/inc/custom-category-color.php';

/**
* Load Jetpack compatibility file.
*/
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* One Click Demo Import after import setup.
*/
if ( class_exists( 'OCDI_Plugin' ) ) {
	require get_template_directory() . '/inc/ocdi.php';
}
