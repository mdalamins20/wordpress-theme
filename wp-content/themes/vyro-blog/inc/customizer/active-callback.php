<?php

/**
 * Active Callbacks
 *
 * @package Vyro Blog
 */

// Theme Options.
function vyro_blog_is_pagination_enabled( $control ) {
	return ( $control->manager->get_setting( 'vyro_blog_enable_pagination' )->value() );
}
function vyro_blog_is_breadcrumb_enabled( $control ) {
	return ( $control->manager->get_setting( 'vyro_blog_enable_breadcrumb' )->value() );
}

// Banner Section.
function vyro_blog_is_banner_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'vyro_blog_enable_banner_section' )->value() );
}
// Banner Slider Section.
function vyro_blog_is_banner_slider_and_content_type_post_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_banner_slider_content_type' )->value();
	return ( vyro_blog_is_banner_section_enabled( $control ) && ( 'post' === $vyro_blog_content_type ) );
}
function vyro_blog_is_banner_slider_and_content_type_category_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_banner_slider_content_type' )->value();
	return ( vyro_blog_is_banner_section_enabled( $control ) && ( 'category' === $vyro_blog_content_type ) );
}
// Banner Editor Choice Section.
function vyro_blog_is_banner_editor_choice_and_content_type_post_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_banner_editor_choice_content_type' )->value();
	return ( vyro_blog_is_banner_section_enabled( $control ) && ( 'post' === $vyro_blog_content_type ) );
}
function vyro_blog_is_banner_editor_choice_and_content_type_category_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_banner_editor_choice_content_type' )->value();
	return ( vyro_blog_is_banner_section_enabled( $control ) && ( 'category' === $vyro_blog_content_type ) );
}

// Categories Section.
function vyro_blog_is_categories_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'vyro_blog_enable_categories_section' )->value() );
}

// Grid Posts Section.
function vyro_blog_is_grid_posts_section_enabled( $control ) {
	return ( $control->manager->get_setting( 'vyro_blog_enable_grid_posts_section' )->value() );
}
function vyro_blog_is_grid_posts_section_and_content_type_post_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_grid_posts_content_type' )->value();
	return ( vyro_blog_is_grid_posts_section_enabled( $control ) && ( 'post' === $vyro_blog_content_type ) );
}
function vyro_blog_is_grid_posts_section_and_content_type_category_enabled( $control ) {
	$vyro_blog_content_type = $control->manager->get_setting( 'vyro_blog_grid_posts_content_type' )->value();
	return ( vyro_blog_is_grid_posts_section_enabled( $control ) && ( 'category' === $vyro_blog_content_type ) );
}

// Check if static home page is enabled.
function vyro_blog_is_static_homepage_enabled( $control ) {
	return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() );
}
