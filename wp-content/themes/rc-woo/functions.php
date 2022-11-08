<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RC Woo
 */

function rc_woo_scripts(){
    // TO ENABLE caching, uncomment this line
    // wp_enqueue_style( 'rc-woo-style', get_stylesheet_uri(), [], '1.0', 'all');

    // TO DISABLE caching, uncomment this line.
    wp_enqueue_style( 'rc-woo-style', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css' ), 'all');
}
add_action('wp_enqueue_scripts', 'rc_woo_scripts');
