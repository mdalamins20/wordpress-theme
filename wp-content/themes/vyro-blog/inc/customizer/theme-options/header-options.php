<?php
/**
 * Header Options
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_header_options',
	array(
		'panel' => 'vyro_blog_theme_options',
		'title' => esc_html__( 'Header Options', 'vyro-blog' ),
	)
);

// Topbar Options - Custom Button.
$wp_customize->add_setting(
	'vyro_blog_header_custom_button',
	array(
		'default'           => __( 'Subscription', 'vyro-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vyro_blog_header_custom_button',
	array(
		'label'    => esc_html__( 'Custom Button', 'vyro-blog' ),
		'section'  => 'vyro_blog_header_options',
		'settings' => 'vyro_blog_header_custom_button',
		'type'     => 'text',
	)
);

// Topbar Options - Custom Button URL.
$wp_customize->add_setting(
	'vyro_blog_header_custom_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'vyro_blog_header_custom_button_url',
	array(
		'label'    => esc_html__( 'Custom Button URL', 'vyro-blog' ),
		'section'  => 'vyro_blog_header_options',
		'settings' => 'vyro_blog_header_custom_button_url',
		'type'     => 'url',
	)
);
