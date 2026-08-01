<?php
/**
 * Option Panel
 *
 * @package blogbrute
 */

function blogbrute_customize_register($wp_customize) {

    $wp_customize->get_setting('show_main_news_section')->default = true;
    $wp_customize->get_setting('blogarise_global_comment_enable')->default = false;
    $wp_customize->get_setting('blogarise_lite_dark_switcher')->default = false;
    $wp_customize->get_setting('blogarise_slider_title_font_size')->default = 35;
    $wp_customize->get_setting('blogarise_slider_overlay_color')->default = '#00000033';
    
    $wp_customize->get_setting('breaking_news_title')->default = __('Top Stories','blogbrute');
    
    $wp_customize->remove_control( 'slider_tabs' );

    $wp_customize->add_setting(
    'slider_tabs',
        array(
            'default'           => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    ); 
    $wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'slider_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'priority' => 1,
            'section'               => 'frontpage_main_banner_section_settings',
            'controls_general'      => json_encode  ( array( '#customize-control-select_slider_news_category',
                                                            '#customize-control-show_main_news_section',
                                                            '#customize-control-slider_right_settings',
                                                            '#customize-control-trending_settings',
                                                            '#customize-control-trending_post_category',
                                                        ) 
                                                    ),

            'controls_design'       => json_encode  (array( '#customize-control-slider_overlay_enable',
                                                            '#customize-control-blogarise_slider_overlay_color', 
                                                            '#customize-control-blogarise_slider_overlay_text_color', 
                                                            '#customize-control-blogarise_slider_title_font_size', 
                                                            '#customize-control-slider_meta_enable',
                                                        )
                                                    ),
        )
    ));
    
    $wp_customize->add_setting(
    'slider_right_settings',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'blogarise_sanitize_text',
        )
    );
    $wp_customize->add_control(
    'slider_right_settings',
        array(
            'type' => 'hidden',
            'label' => __('Featured Slider','blogbrute'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 10,
        )
    );
    
    $wp_customize->add_setting(
    'trending_settings',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'blogarise_sanitize_text',
        )
    );
    $wp_customize->add_control(
    'trending_settings',
        array(
            'type' => 'hidden',
            'label' => __('Trending Posts','blogbrute'),
            'section' => 'frontpage_main_banner_section_settings',
            'priority' => 101,
        )
    );
    
    // Setting - drop down category for slider.
    $wp_customize->add_setting('trending_post_category',
        array(
            'default' => 0,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    ); 
    $wp_customize->add_control(new Blogarise_Dropdown_Taxonomies_Control($wp_customize, 'trending_post_category',
        array(
            'label' => esc_html__('Category', 'blogbrute'),
            'description' => esc_html__('Posts to be shown on Trending Posts section', 'blogbrute'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 101,
            'active_callback' => 'blogarise_main_banner_section_status',
        ))
    );
}
add_action('customize_register', 'blogbrute_customize_register');