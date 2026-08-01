<?php
/**
 * Banner Section
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_banner_section',
	array(
		'panel' => 'vyro_blog_front_page_options',
		'title' => esc_html__( 'Banner Section', 'vyro-blog' ),
	)
);

// Banner Section - Enable Section.
$wp_customize->add_setting(
	'vyro_blog_enable_banner_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_enable_banner_section',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'vyro-blog' ),
			'section'  => 'vyro_blog_banner_section',
			'settings' => 'vyro_blog_enable_banner_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'vyro_blog_enable_banner_section',
		array(
			'selector' => '#vyro_blog_banner_section .section-link',
			'settings' => 'vyro_blog_enable_banner_section',
		)
	);
}

// Banner Section Main - Heading.
$wp_customize->add_setting(
	'vyro_blog_banner_section_area',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Title_Control(
		$wp_customize,
		'vyro_blog_banner_section_area',
		array(
			'label'           => __( 'Banner Editor Choice Settings', 'vyro-blog' ),
			'section'         => 'vyro_blog_banner_section',
			'settings'        => 'vyro_blog_banner_section_area',
			'active_callback' => 'vyro_blog_is_banner_section_enabled',
		)
	)
);

// Banner Section - Editor Choice Content Type.
$wp_customize->add_setting(
	'vyro_blog_banner_editor_choice_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_banner_editor_choice_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'vyro-blog' ),
		'section'         => 'vyro_blog_banner_section',
		'settings'        => 'vyro_blog_banner_editor_choice_content_type',
		'type'            => 'select',
		'active_callback' => 'vyro_blog_is_banner_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'vyro-blog' ),
			'category' => esc_html__( 'Category', 'vyro-blog' ),
		),
	)
);

// Banner Section - Select Editor Choice Category.
$wp_customize->add_setting(
	'vyro_blog_banner_editor_choice_content_category',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_banner_editor_choice_content_category',
	array(
		'label'           => esc_html__( 'Select Category', 'vyro-blog' ),
		'section'         => 'vyro_blog_banner_section',
		'settings'        => 'vyro_blog_banner_editor_choice_content_category',
		'active_callback' => 'vyro_blog_is_banner_editor_choice_and_content_type_category_enabled',
		'type'            => 'select',
		'choices'         => vyro_blog_get_post_cat_choices(),
	)
);

for ( $vyro_blog_i = 1; $vyro_blog_i <= 4; $vyro_blog_i++ ) {

	// Banner Section - Select Banner Editor Choice Post.
	$wp_customize->add_setting(
		'vyro_blog_banner_editor_choice_content_post_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'vyro_blog_banner_editor_choice_content_post_' . $vyro_blog_i,
		array(
			'label'           => sprintf( esc_html__( 'Select Post %d', 'vyro-blog' ), $vyro_blog_i ),
			'section'         => 'vyro_blog_banner_section',
			'settings'        => 'vyro_blog_banner_editor_choice_content_post_' . $vyro_blog_i,
			'active_callback' => 'vyro_blog_is_banner_editor_choice_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => vyro_blog_get_post_choices(),
		)
	);

}

// Banner Section Main - Heading.
$wp_customize->add_setting(
	'vyro_blog_main_banner_area',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Title_Control(
		$wp_customize,
		'vyro_blog_main_banner_area',
		array(
			'label'           => __( 'Main Banner Settings', 'vyro-blog' ),
			'section'         => 'vyro_blog_banner_section',
			'settings'        => 'vyro_blog_main_banner_area',
			'active_callback' => 'vyro_blog_is_banner_section_enabled',
		)
	)
);

// Banner Section - Slider Content Type.
$wp_customize->add_setting(
	'vyro_blog_banner_slider_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_banner_slider_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'vyro-blog' ),
		'section'         => 'vyro_blog_banner_section',
		'settings'        => 'vyro_blog_banner_slider_content_type',
		'type'            => 'select',
		'active_callback' => 'vyro_blog_is_banner_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'vyro-blog' ),
			'category' => esc_html__( 'Category', 'vyro-blog' ),
		),
	)
);

// Banner Section - Select Banner Category.
$wp_customize->add_setting(
	'vyro_blog_banner_slider_content_category',
	array(
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_banner_slider_content_category',
	array(
		'label'           => esc_html__( 'Select Category', 'vyro-blog' ),
		'section'         => 'vyro_blog_banner_section',
		'settings'        => 'vyro_blog_banner_slider_content_category',
		'active_callback' => 'vyro_blog_is_banner_slider_and_content_type_category_enabled',
		'type'            => 'select',
		'choices'         => vyro_blog_get_post_cat_choices(),
	)
);

for ( $vyro_blog_i = 1; $vyro_blog_i <= 3; $vyro_blog_i++ ) {

	// Banner Section - Select Banner Post.
	$wp_customize->add_setting(
		'vyro_blog_banner_slider_content_post_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'vyro_blog_banner_slider_content_post_' . $vyro_blog_i,
		array(
			'label'           => sprintf( esc_html__( 'Select Post %d', 'vyro-blog' ), $vyro_blog_i ),
			'section'         => 'vyro_blog_banner_section',
			'settings'        => 'vyro_blog_banner_slider_content_post_' . $vyro_blog_i,
			'active_callback' => 'vyro_blog_is_banner_slider_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => vyro_blog_get_post_choices(),
		)
	);

}
