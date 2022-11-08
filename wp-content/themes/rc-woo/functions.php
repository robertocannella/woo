<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RC Woo
 */

function rc_woo_scripts(){

    wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/inc/bootstrap.min.js',['jquery'],'5.2.2', true);
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', [], '5.2.2', 'all');

    // TO ENABLE caching, uncomment this line
    // wp_enqueue_style( 'rc-woo-style', get_stylesheet_uri(), [], '1.0', 'all');

    // TO DISABLE caching, uncomment this line.
    wp_enqueue_style( 'rc-woo-style', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css' ), 'all');
}
add_action('wp_enqueue_scripts', 'rc_woo_scripts');


function rc_woo_config() {
    register_nav_menus([
        'rc_woo_main_menu'  => 'RC Woo Main Menu',
        'rc_woo_footer_menu'=> 'RC Woo Footer Menu'
    ]);


}
add_action('after_setup_theme', 'rc_woo_config', 0);