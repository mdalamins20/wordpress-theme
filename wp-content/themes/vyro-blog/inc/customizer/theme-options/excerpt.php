<?php
/**
 * Excerpt
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_excerpt_options',
	array(
		'panel' => 'vyro_blog_theme_options',
		'title' => esc_html__( 'Excerpt', 'vyro-blog' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'vyro_blog_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'vyro_blog_sanitize_number_range',
		'validate_callback' => 'vyro_blog_validate_excerpt_length',
	)
);

$wp_customize->add_control(
	'vyro_blog_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'vyro-blog' ),
		'description' => esc_html__( 'Note: Min 1 & Max 100. Please input the valid number and save. Then refresh the page to see the change.', 'vyro-blog' ),
		'section'     => 'vyro_blog_excerpt_options',
		'settings'    => 'vyro_blog_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'max'  => 200,
			'step' => 1,
		),
	)
);
