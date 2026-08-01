<?php
/**
 * Breadcrumb
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_breadcrumb',
	array(
		'title' => esc_html__( 'Breadcrumb', 'vyro-blog' ),
		'panel' => 'vyro_blog_theme_options',
	)
);

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'vyro_blog_enable_breadcrumb',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'vyro-blog' ),
			'section' => 'vyro_blog_breadcrumb',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'vyro_blog_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'vyro_blog_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'vyro-blog' ),
		'active_callback' => 'vyro_blog_is_breadcrumb_enabled',
		'section'         => 'vyro_blog_breadcrumb',
	)
);
