<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RC-Woo
 */

get_header(); ?>

    <div class="content-area">
        <div class="main">
            <section class="slider">
                <div class="container">
                    <div class="row">Slider</div>
                </div>
            </section>
            <section class="popular-products">
                <div class="container">
                    <div class="row">Popular Products</div>
                </div>
            </section>
            <section class="new-arrivals">
                <div class="container">
                    <div class="row">New Arrivals</div>
                </div>
            </section>
            <section class="deal-of-the-week">
                <div class="container">
                    <div class="row">Deal of the Week</div>
                </div>
            </section>
            <section class="woo-blog">
                <div class="container">
                    <div class="row">Newss</div>
                </div>
            </section>

        </div>
    </div>

<?php get_footer();?>