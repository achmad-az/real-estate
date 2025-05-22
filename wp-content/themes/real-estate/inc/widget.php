<?php
/**
 * Widget Registration
 *
 * @package Real Estate
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register widget areas
 */
function rela_estate_register_sidebars() {

    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'real-estate'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here for the first footer column.', 'real-estate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title justify-start text-[#999999] text-lg font-primary-medium leading-normal">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'real-estate'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here for the second footer column.', 'real-estate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title justify-start text-[#999999] text-lg font-primary-medium leading-normal">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        
        'name'          => __('Footer Widget Area 3', 'real-estate'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here for the third footer column.', 'real-estate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title justify-start text-[#999999] text-lg font-primary-medium leading-normal">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        
        'name'          => __('Footer Widget Area 4', 'real-estate'),
        'id'            => 'footer-4',
        'description'   => __('Add widgets here for the third footer column.', 'real-estate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title justify-start text-[#999999] text-lg font-primary-medium leading-normal">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        
        'name'          => __('Footer Widget Area 5', 'real-estate'),
        'id'            => 'footer-5',
        'description'   => __('Add widgets here for the third footer column.', 'real-estate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title justify-start text-[#999999] text-lg font-primary-medium leading-normal">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'rela_estate_register_sidebars');

/**
 * Register custom widgets
 */
function rela_estate_register_custom_widgets() {
    // If you need to register custom widgets, add them here
}
add_action('widgets_init', 'rela_estate_register_custom_widgets');