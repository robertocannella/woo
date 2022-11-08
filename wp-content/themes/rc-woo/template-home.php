<?php
/*
 * Template Name: Home Page
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
                    <div class="row">

                        <?php
                        if (have_posts()):
                            while (have_posts()): the_post();
                                ?>
                                <article>
                                    <h2><?php the_title(); ?> </h2>
                                    <div><?php the_content(); ?></div>
                                </article>

                            <?php
                            endwhile;
                        else:
                            ?>
                            <h2>Nothing to display.</h2>
                        <?php endif; ?>

                    </div>
                </div>
            </section>

        </div>
    </div>

<?php get_footer();?>