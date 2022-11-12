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

//Add WooCommerce Support
function rc_woo_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 10,
            'default_columns' => 1,
            'min_columns'     => 1,
            'max_columns'     => 1,
        ),
    ) );
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    if ( ! isset( $content_width ) ) {
        $content_width = 600;
    }
}
add_action( 'after_setup_theme', 'rc_woo_add_woocommerce_support' );


function rc_woo_sidebars(){
    register_sidebar([
        'name' => 'RC Woo Main Sidebar',
        'id' => 'rc-woo-sidebar-1',
        'description' => 'Drag and Drop your widgets here!',
        'before_widget' => '<section id="%1$s" class="widget widget-wrapper %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class=widget-title>',
        'after_title'=> '</h4>'
    ]);
}

add_action( 'widgets_init','rc_woo_sidebars');

add_action('woocommerce_before_main_content', 'rc_woo_open_container_row',5);
function rc_woo_open_container_row(){
    echo '<div class="container shop-content"><div class="row">';
}

add_action('woocommerce_after_shop_loop', 'rc_woo_close_container_row',5);
function rc_woo_close_container_row(){
    echo '</div></div>';
}

function rc_woo_add_sidebar_tags(){
    echo '<div class="sidebar-shop col-lg-9 col-md-8 col-12">';
}
add_action('woocommerce_before_main_content', 'rc_woo_add_sidebar_tags',6);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
add_action('woocommerce_before_main_content','woocommerce_get_sidebar',7);

function rc_woo_close_sidebar_tags(){
    echo '</div>';
}
add_action('woocommerce_before_main_content','rc_woo_close_sidebar_tags',8);
