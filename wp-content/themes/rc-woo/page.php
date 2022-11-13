<?php
/**
 * The page template file
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
                <div class="container">
                    <div class="row">

                        <?php
                        if (have_posts()):
                            while (have_posts()): the_post();
                                ?>
                                <article class="col">
                                    <h1><?php the_title(); ?> </h1>
                                    <div><?php the_content(); ?></div>
                                </article>

                            <?php
                            endwhile;
                        else:
                            ?>
                            Nothing to display.
                        <?php endif; ?>

                    </div>
                </div>

        </div>
    </div>

<?php get_footer();?>