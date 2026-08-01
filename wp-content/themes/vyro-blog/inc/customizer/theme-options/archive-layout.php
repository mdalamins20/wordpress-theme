<?php
/**
 * Archive Layout
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_archive_layout',
	array(
		'title' => esc_html__( 'Archive Layout', 'vyro-blog' ),
		'panel' => 'vyro_blog_theme_options',
	)
);

// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'vyro_blog_column_layout',
	array(
		'default'           => 'column-2',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_column_layout',
	array(
		'label'   => esc_html__( 'Column Layout', 'vyro-blog' ),
		'section' => 'vyro_blog_archive_layout',
		'type'    => 'select',
		'choices' => array(
			'column-2' => __( 'Column 2', 'vyro-blog' ),
			'column-3' => __( 'Column 3', 'vyro-blog' ),
		),
	)
);
