<?php
/*
 * Modifications to Woo Commerce
 *
 * @package RC Woo
 */

function rc_woo_wc_modify (){

    remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
    /*
    * Side Bar
    */
    add_action('woocommerce_before_main_content', 'rc_woo_open_container_row', 5);
    function rc_woo_open_container_row()
    {
        echo '<div class="container shop-content"><div class="row">';
    }

    add_action('woocommerce_after_main_content', 'rc_woo_close_container_row', 5);
    function rc_woo_close_container_row()
    {
        echo '</div></div>';
    }


    if (is_shop() ) {

        ?>

        <script>
            console.log("Inside Shop Function");
        </script>

        <?php

        function rc_woo_woocommerce_get_sidebar(){?>
            <aside class="col-lg-3 col-md-4 col-12 h-100">
            <?php dynamic_sidebar('rc-woo-sidebar-2'); ?>
            </aside>
            <?php
        }
        add_action ('woocommerce_before_main_content','rc_woo_woocommerce_get_sidebar',7);
        add_action('woocommerce_after_shop_loop_item', 'the_excerpt');
    }

    function rc_woo_open_main_content (){
        if (is_shop() ){
            echo '<div class="order-1 order-md2  col-lg-9 col-md-8">';

        }else {
            echo '<div class="col">';
        }
    }
    add_action('woocommerce_before_main_content', 'rc_woo_open_main_content', 9);


    function re_woo_remove_shop_title ($val){
        $val = false;
        return $val;
    }
    add_filter('woocommerce_show_page_title','re_woo_remove_shop_title');

}
add_action('wp','rc_woo_wc_modify');