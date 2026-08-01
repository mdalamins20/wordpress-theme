<?php
/**
 * Footer Options
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_footer_options',
	array(
		'panel' => 'vyro_blog_theme_options',
		'title' => esc_html__( 'Footer Options', 'vyro-blog' ),
	)
);

// Footer Options - Copyright Text.
/* translators: 1: Year, 2: Site Title with home URL. */
$vyro_blog_copyright_default = sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s', '1: Year, 2: Site Title with home URL', 'vyro-blog' ), '[the-year]', '[site-link]' );
$wp_customize->add_setting(
	'vyro_blog_footer_copyright_text',
	array(
		'default'           => $vyro_blog_copyright_default,
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_control(
	'vyro_blog_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'vyro-blog' ),
		'section'  => 'vyro_blog_footer_options',
		'settings' => 'vyro_blog_footer_copyright_text',
		'type'     => 'textarea',
	)
);
