<?php
/**
 * Pagination
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_pagination',
	array(
		'panel' => 'vyro_blog_theme_options',
		'title' => esc_html__( 'Pagination', 'vyro-blog' ),
	)
);

// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'vyro_blog_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'vyro-blog' ),
			'section'  => 'vyro_blog_pagination',
			'settings' => 'vyro_blog_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'vyro_blog_pagination_type',
	array(
		'default'           => 'numeric',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'vyro-blog' ),
		'section'         => 'vyro_blog_pagination',
		'settings'        => 'vyro_blog_pagination_type',
		'active_callback' => 'vyro_blog_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'vyro-blog' ),
			'numeric' => __( 'Numeric', 'vyro-blog' ),
		),
	)
);
