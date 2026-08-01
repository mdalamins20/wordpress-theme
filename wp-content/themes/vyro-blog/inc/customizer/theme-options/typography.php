<?php
/**
 * Typography
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_typography',
	array(
		'panel' => 'vyro_blog_theme_options',
		'title' => esc_html__( 'Typography', 'vyro-blog' ),
	)
);

// Typography - Site Title Font.
$wp_customize->add_setting(
	'vyro_blog_site_title_font',
	array(
		'default'           => 'Yatra One',
		'sanitize_callback' => 'vyro_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'vyro_blog_site_title_font',
	array(
		'label'    => esc_html__( 'Site Title Font Family', 'vyro-blog' ),
		'section'  => 'vyro_blog_typography',
		'settings' => 'vyro_blog_site_title_font',
		'type'     => 'select',
		'choices'  => vyro_blog_get_all_google_font_families(),
	)
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'vyro_blog_site_description_font',
	array(
		'default'           => 'Public Sans',
		'sanitize_callback' => 'vyro_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'vyro_blog_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'vyro-blog' ),
		'section'  => 'vyro_blog_typography',
		'settings' => 'vyro_blog_site_description_font',
		'type'     => 'select',
		'choices'  => vyro_blog_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'vyro_blog_header_font',
	array(
		'default'           => 'Inter',
		'sanitize_callback' => 'vyro_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'vyro_blog_header_font',
	array(
		'label'    => esc_html__( 'Header Font Family', 'vyro-blog' ),
		'section'  => 'vyro_blog_typography',
		'settings' => 'vyro_blog_header_font',
		'type'     => 'select',
		'choices'  => vyro_blog_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'vyro_blog_body_font',
	array(
		'default'           => 'Roboto',
		'sanitize_callback' => 'vyro_blog_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'vyro_blog_body_font',
	array(
		'label'    => esc_html__( 'Body Font Family', 'vyro-blog' ),
		'section'  => 'vyro_blog_typography',
		'settings' => 'vyro_blog_body_font',
		'type'     => 'select',
		'choices'  => vyro_blog_get_all_google_font_families(),
	)
);
