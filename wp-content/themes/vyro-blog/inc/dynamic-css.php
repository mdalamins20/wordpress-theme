<?php

/**
 * Dynamic CSS
 */
function vyro_blog_dynamic_css() {

	$vyro_blog_site_title_font       = get_theme_mod( 'vyro_blog_site_title_font', 'Yatra One' );
	$vyro_blog_site_description_font = get_theme_mod( 'vyro_blog_site_description_font', 'Public Sans' );
	$vyro_blog_header_font           = get_theme_mod( 'vyro_blog_header_font', 'Inter' );
	$vyro_blog_body_font             = get_theme_mod( 'vyro_blog_body_font', 'Roboto' );

	$vyro_blog_custom_css  = '';
	$vyro_blog_custom_css .= '
	/* Color */
	:root {
		--site-title-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
	}
	';

	$vyro_blog_custom_css .= '
	/* Typograhpy */
	:root {
		--font-heading: "' . esc_attr( $vyro_blog_header_font ) . '", serif;
		--font-main: -apple-system, BlinkMacSystemFont,"' . esc_attr( $vyro_blog_body_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	}

	body,
	button, input, select, optgroup, textarea {
		font-family: "' . esc_attr( $vyro_blog_body_font ) . '", serif;
	}

	.site-title a {
		font-family: "' . esc_attr( $vyro_blog_site_title_font ) . '", serif;
	}

	.site-description {
		font-family: "' . esc_attr( $vyro_blog_site_description_font ) . '", serif;
	}
	';

	wp_add_inline_style( 'vyro-blog-style', $vyro_blog_custom_css );
}

add_action( 'wp_enqueue_scripts', 'vyro_blog_dynamic_css', 99 );
