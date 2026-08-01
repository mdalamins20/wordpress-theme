<?php
/**
 * Grid Posts Section
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_grid_posts_section',
	array(
		'panel' => 'vyro_blog_front_page_options',
		'title' => esc_html__( 'Grid Posts Section', 'vyro-blog' ),
	)
);

// Grid Posts Section - Enable Section.
$wp_customize->add_setting(
	'vyro_blog_enable_grid_posts_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_enable_grid_posts_section',
		array(
			'label'    => esc_html__( 'Enable Grid Posts Section', 'vyro-blog' ),
			'section'  => 'vyro_blog_grid_posts_section',
			'settings' => 'vyro_blog_enable_grid_posts_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'vyro_blog_enable_grid_posts_section',
		array(
			'selector' => '#vyro_blog_grid_posts_section .section-link',
			'settings' => 'vyro_blog_enable_grid_posts_section',
		)
	);
}

// Grid Posts Section - Section Title.
$wp_customize->add_setting(
	'vyro_blog_grid_posts_section_title',
	array(
		'default'           => __( 'Grid Posts Section', 'vyro-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vyro_blog_grid_posts_section_title',
	array(
		'label'           => esc_html__( 'Section Title', 'vyro-blog' ),
		'section'         => 'vyro_blog_grid_posts_section',
		'settings'        => 'vyro_blog_grid_posts_section_title',
		'type'            => 'text',
		'active_callback' => 'vyro_blog_is_grid_posts_section_enabled',
	)
);

// Grid Posts Section - Content Type.
$wp_customize->add_setting(
	'vyro_blog_grid_posts_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_grid_posts_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'vyro-blog' ),
		'section'         => 'vyro_blog_grid_posts_section',
		'settings'        => 'vyro_blog_grid_posts_content_type',
		'type'            => 'select',
		'active_callback' => 'vyro_blog_is_grid_posts_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'vyro-blog' ),
			'category' => esc_html__( 'Category', 'vyro-blog' ),
		),
	)
);

// Grid Posts Section - Select Grid Posts Category.
$wp_customize->add_setting(
	'vyro_blog_grid_posts_content_category',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_grid_posts_content_category',
	array(
		'label'           => esc_html__( 'Select Category', 'vyro-blog' ),
		'section'         => 'vyro_blog_grid_posts_section',
		'settings'        => 'vyro_blog_grid_posts_content_category',
		'active_callback' => 'vyro_blog_is_grid_posts_section_and_content_type_category_enabled',
		'type'            => 'select',
		'choices'         => vyro_blog_get_post_cat_choices(),
	)
);

for ( $vyro_blog_i = 1; $vyro_blog_i <= 3; $vyro_blog_i++ ) {
	// Grid Posts Section - Select Post.
	$wp_customize->add_setting(
		'vyro_blog_grid_posts_content_post_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'vyro_blog_grid_posts_content_post_' . $vyro_blog_i,
		array(
			'label'           => sprintf( esc_html__( 'Select Post %d', 'vyro-blog' ), $vyro_blog_i ),
			'section'         => 'vyro_blog_grid_posts_section',
			'settings'        => 'vyro_blog_grid_posts_content_post_' . $vyro_blog_i,
			'active_callback' => 'vyro_blog_is_grid_posts_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => vyro_blog_get_post_choices(),
		)
	);

}

// Grid Posts Section - View All Button.
$wp_customize->add_setting(
	'vyro_blog_grid_posts_view_all_button_label',
	array(
		'default'           => __( 'View All', 'vyro-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vyro_blog_grid_posts_view_all_button_label',
	array(
		'label'           => esc_html__( 'Button Label', 'vyro-blog' ),
		'section'         => 'vyro_blog_grid_posts_section',
		'settings'        => 'vyro_blog_grid_posts_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'vyro_blog_is_grid_posts_section_enabled',
	)
);

// Grid Posts Section - View All Button URL.
$wp_customize->add_setting(
	'vyro_blog_grid_posts_view_all_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'vyro_blog_grid_posts_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button URL', 'vyro-blog' ),
		'section'         => 'vyro_blog_grid_posts_section',
		'settings'        => 'vyro_blog_grid_posts_view_all_button_url',
		'active_callback' => 'vyro_blog_is_grid_posts_section_enabled',
		'type'            => 'url',
	)
);
