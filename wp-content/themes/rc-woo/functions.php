<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RC Woo
 */



/**
 * Font Awesome Kit Setup
 *
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */
if (! function_exists('fa_custom_setup_kit') ) {
    function fa_custom_setup_kit($kit_url = '') {
        foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
            add_action(
                $action,
                function () use ( $kit_url ) {
                    wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
                }
            );

            ?>
            <i></i>
                <script src="https://kit.fontawesome.com/rc-fa-2022.js" crossorigin="anonymous"></script>
            <script>
                console.log("inside load fa:<?php echo $kit_url; ?>")

            </script>
            <?php
        }
    }
}
function rc_woo_scripts(){

    wp_enqueue_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js', ['jquery'],'3.9.1',true );
    wp_enqueue_script( 'boot1','https://code.jquery.com/jquery-3.3.1.slim.min.js', array( 'jquery' ),'',true );
    wp_enqueue_script( 'boot2','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array( 'jquery' ),'',true );
    //wp_enqueue_script( 'boot3','https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array( 'jquery' ),'',true );
    wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/inc/bootstrap.min.js',['jquery'],'5.2.2', true);
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', [], '5.2.2', 'all');
   // wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css' );
    //fa_custom_setup_kit('https://kit.fontawesome.com/rc-fa-2022.js');
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
        'after_widget' => '</section>',
        'before_title' => '<h4 class=widget-title>',
        'after_title'=> '</h4>'
    ]);

    register_sidebar([
        'name' => 'RC Woo WooCommerce Sidebar',
        'id' => 'rc-woo-sidebar-2',
        'description' => 'Drag and Drop your widgets here!',
        'before_widget' => '<section id="%1$s" class="widget widget-wrapper %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class=widget-title>',
        'after_title'=> '</h4>'
    ]);
}

add_action( 'widgets_init','rc_woo_sidebars');
if (class_exists('WooCommerce')){
    require get_template_directory() . '/inc/wp-modifications.php';
}

require get_template_directory() . '/inc/rc-tiny-mce.php';
// TEST CODE BELOW HERE
// show a custom login message above the login form
function custom_login_message( $message ) {
    if ( empty( $message ) ) {
        return "<h2>Welcome to Let's Develop by Salman Ravoof! Please log in to start learning.</h2>";
    }
    else {
        return $message;
    }
}




/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */


function my_login_redirect( $redirect_to, $request, $user ) {

    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return home_url();
            echo home_url();
        }
    } else {
        return $redirect_to;
    }
}

//add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
