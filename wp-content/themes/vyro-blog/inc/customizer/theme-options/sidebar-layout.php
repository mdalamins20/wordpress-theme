<?php
/**
 * Sidebar Option
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_sidebar_option',
	array(
		'title' => esc_html__( 'Layout', 'vyro-blog' ),
		'panel' => 'vyro_blog_theme_options',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'vyro_blog_sidebar_position',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'vyro_blog_sidebar_position',
	array(
		'label'   => esc_html__( 'Global Sidebar Position', 'vyro-blog' ),
		'section' => 'vyro_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'vyro-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'vyro-blog' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'vyro_blog_post_sidebar_position',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'vyro_blog_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'vyro-blog' ),
		'section' => 'vyro_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'vyro-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'vyro-blog' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'vyro_blog_page_sidebar_position',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'vyro_blog_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'vyro-blog' ),
		'section' => 'vyro_blog_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'vyro-blog' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'vyro-blog' ),
		),
	)
);
