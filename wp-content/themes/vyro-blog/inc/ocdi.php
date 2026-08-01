<?php

function vyro_blog_intro_text( $vyro_blog_default_text ) {
	$vyro_blog_default_text .= sprintf(
		'<div class="notice notice-info vyro-blog-demo-data"><p class="demo-file-content">%1$s <a href="%2$s" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Demo content files for Vyro Blog Theme.', 'vyro-blog' ),
		esc_url( 'https://docs.ascendoor.com/docs/vyro-blog/getting-started/import-demo-data/' ),
		esc_html__( 'Click here to download demo files.', 'vyro-blog' )
	);
	return $vyro_blog_default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'vyro_blog_intro_text' );

/**
 * OCDI after import.
 */
function vyro_blog_after_import_setup() {
	// Assign menus to their locations.
	$vyro_blog_primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$vyro_blog_social_menu  = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary' => $vyro_blog_primary_menu->term_id,
			'social'  => $vyro_blog_social_menu->term_id,
		)
	);

}
add_action( 'ocdi/after_import', 'vyro_blog_after_import_setup' );
