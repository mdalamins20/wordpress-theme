<?php
/**
 * Categories Section
 *
 * @package Vyro Blog
 */

$wp_customize->add_section(
	'vyro_blog_categories_section',
	array(
		'panel' => 'vyro_blog_front_page_options',
		'title' => esc_html__( 'Categories Section', 'vyro-blog' ),
	)
);

// Categories Section - Enable Section.
$wp_customize->add_setting(
	'vyro_blog_enable_categories_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'vyro_blog_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Vyro_Blog_Toggle_Switch_Custom_Control(
		$wp_customize,
		'vyro_blog_enable_categories_section',
		array(
			'label'    => esc_html__( 'Enable Categories Section', 'vyro-blog' ),
			'section'  => 'vyro_blog_categories_section',
			'settings' => 'vyro_blog_enable_categories_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'vyro_blog_enable_categories_section',
		array(
			'selector' => '#vyro_blog_categories_section .section-link',
			'settings' => 'vyro_blog_enable_categories_section',
		)
	);
}

// Categories Section - Section Title.
$wp_customize->add_setting(
	'vyro_blog_categories_title',
	array(
		'default'           => __( 'Categories Section', 'vyro-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'vyro_blog_categories_title',
	array(
		'label'           => esc_html__( 'Section Title', 'vyro-blog' ),
		'section'         => 'vyro_blog_categories_section',
		'settings'        => 'vyro_blog_categories_title',
		'type'            => 'text',
		'active_callback' => 'vyro_blog_is_categories_section_enabled',
	)
);

// Categories Section - Content Type.
$wp_customize->add_setting(
	'vyro_blog_categories_content_type',
	array(
		'default'           => 'category',
		'sanitize_callback' => 'vyro_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'vyro_blog_categories_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'vyro-blog' ),
		'section'         => 'vyro_blog_categories_section',
		'settings'        => 'vyro_blog_categories_content_type',
		'type'            => 'select',
		'active_callback' => 'vyro_blog_is_categories_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'vyro-blog' ),
			'category' => esc_html__( 'Category', 'vyro-blog' ),
		),
	)
);

for ( $vyro_blog_i = 1; $vyro_blog_i <= 4; $vyro_blog_i++ ) {

	// Categories Section - Select Category.
	$wp_customize->add_setting(
		'vyro_blog_categories_content_category_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'vyro_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'vyro_blog_categories_content_category_' . $vyro_blog_i,
		array(
			'label'           => sprintf( esc_html__( 'Select Category %d', 'vyro-blog' ), $vyro_blog_i ),
			'section'         => 'vyro_blog_categories_section',
			'settings'        => 'vyro_blog_categories_content_category_' . $vyro_blog_i,
			'active_callback' => 'vyro_blog_is_categories_section_enabled',
			'type'            => 'select',
			'choices'         => vyro_blog_get_post_cat_choices(),
		)
	);

	// Categories Section - Category Image.
	$wp_customize->add_setting(
		'vyro_blog_category_category_image_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'vyro_blog_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'vyro_blog_category_category_image_' . $vyro_blog_i,
			array(
				'label'           => sprintf( esc_html__( 'Category Image %d', 'vyro-blog' ), $vyro_blog_i ),
				'section'         => 'vyro_blog_categories_section',
				'settings'        => 'vyro_blog_category_category_image_' . $vyro_blog_i,
				'active_callback' => 'vyro_blog_is_categories_section_enabled',
			)
		)
	);

	// Categories Section - Horizontal Line.
	$wp_customize->add_setting(
		'vyro_blog_categories_horizontal_line_' . $vyro_blog_i,
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Vyro_Blog_Customize_Horizontal_Line(
			$wp_customize,
			'vyro_blog_categories_horizontal_line_' . $vyro_blog_i,
			array(
				'section'         => 'vyro_blog_categories_section',
				'settings'        => 'vyro_blog_categories_horizontal_line_' . $vyro_blog_i,
				'active_callback' => 'vyro_blog_is_categories_section_enabled',
				'type'            => 'hr',
			)
		)
	);

}
