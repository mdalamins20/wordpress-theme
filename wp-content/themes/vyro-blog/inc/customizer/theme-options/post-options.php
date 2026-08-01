<?php
/**
 * Post Options
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'vyro-blog' ),
		'panel' => 'vyro_blog_theme_options',
	)
);

// Post Options - Hide Date.
$wp_customize->add_setting(
	'vyro_blog_post_hide_date',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_post_hide_date',
		array(
			'label'   => esc_html__( 'Hide Date', 'vyro-blog' ),
			'section' => 'vyro_blog_post_options',
		)
	)
);

// Post Options - Hide Author.
$wp_customize->add_setting(
	'vyro_blog_post_hide_author',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_post_hide_author',
		array(
			'label'   => esc_html__( 'Hide Author', 'vyro-blog' ),
			'section' => 'vyro_blog_post_options',
		)
	)
);

// Post Options - Hide Category.
$wp_customize->add_setting(
	'vyro_blog_post_hide_category',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_post_hide_category',
		array(
			'label'   => esc_html__( 'Hide Category', 'vyro-blog' ),
			'section' => 'vyro_blog_post_options',
		)
	)
);

// Post Options - Hide Tag.
$wp_customize->add_setting(
	'vyro_blog_post_hide_tags',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_post_hide_tags',
		array(
			'label'   => esc_html__( 'Hide Tag', 'vyro-blog' ),
			'section' => 'vyro_blog_post_options',
		)
	)
);

// Post Options - Related Post Label.
$wp_customize->add_setting(
	'vyro_blog_post_related_post_label',
	array(
		'default'           => __( 'Related Posts', 'vyro-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vyro_blog_post_related_post_label',
	array(
		'label'    => esc_html__( 'Related Posts Label', 'vyro-blog' ),
		'section'  => 'vyro_blog_post_options',
		'settings' => 'vyro_blog_post_related_post_label',
		'type'     => 'text',
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'vyro_blog_post_related_post_label',
		array(
			'selector' => '.related-posts h2',
			'settings' => 'vyro_blog_post_related_post_label',
		)
	);
}
