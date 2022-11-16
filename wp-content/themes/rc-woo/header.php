<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' );?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head() ?>
</head>
<body <?php
    if (class_exists('WooCommerce')):
        if (is_account_page() && !is_user_logged_in()):
            wp_enqueue_script( 'r-woo-js', get_template_directory_uri() . '/inc/js/rc-woo.js', [], '1.0', true );
            body_class('account-page');
        else:
            body_class();
        endif;
    else:
        body_class();
    endif;

    body_class();
    ?>>
<div id="page" class="site">
    <header>
        <section class="search">
            <div class="container">Search</div>
        </section>
        <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="brand col-3">Logo</div>
                    <div class="second-column col-9">
                        <div class="account">Account</div>
                        <div class="main-menu">
                            <?php wp_nav_menu([
                                 'theme_location' =>   'rc_woo_main_menu'
                                ])?>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </header>