<?php
/**
 * Template Name: Bar Chart
 *
 * @package RC Woo
 */

get_header();
echo '<h1>Bar Chart </h1>';

                if (have_posts()):
                    while (have_posts()): the_post();


                        add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );

                        function filter_the_content_in_the_main_loop( $content ) {

                            // Check if we're inside the main loop in a single Post.
                            if ( is_singular() && in_the_loop() && is_main_query() ) {
                                $DOM = new DOMDocument();
                                $stripped = strip_tags($content ,['table','th','tr','td']);
                                $DOM->loadHTML($stripped);
                                $Header = $DOM->getElementsByTagName('th');
                                $Detail = $DOM->getElementsByTagName('td');
                                $aDataTableHeaderHTML = [];
                                $aDataTableDetailHTML = [];
                                $aTempData = [];
                                //#Get header name of the table
                                foreach($Header as $NodeHeader)
                                {
                                    $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
                                }

                               // print_r($aDataTableHeaderHTML); die();
                                //#Get row data/detail table without header name as key
                                $i = 0;
                                $j = 0;
                                foreach($Detail as $sNodeDetail)
                                {
                                    $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
                                    $i = $i + 1;
                                    $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
                                }
                                //print_r($aDataTableDetailHTML); die();

                                //#Get row data/detail table with header name as key and outer array index as row number
                                for($i = 0; $i < count($aDataTableDetailHTML); $i++)
                                {
                                    for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
                                    {
                                        $aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
                                    }
                                }
                                $aDataTableDetailHTML = $aTempData; unset($aTempData);

                                $script  = 'customTitle = '. json_encode(get_the_title()) .'; ';
                                $script  .= 'themeParams = '. json_encode($aDataTableDetailHTML) .'; ';
                                $script  .= 'var1 = '. json_encode($aDataTableDetailHTML) .'; ';


                                wp_enqueue_script('barChart', get_template_directory_uri() . '/inc/js/barChart.js', ['jquery'],'1',true );
                                wp_add_inline_script( 'barChart', $script, 'before' );

                                add_action('wp_print_scripts', 'barChart');

                            }

                           // return $content;
                        }


                        ?>
                        <article>
                            <div><?php the_content(); ?></div>
                        </article>

                    <?php
                    endwhile;
                else:
                    ?>
                    <h2>Nothing to display.</h2>
                <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <canvas class="rc-chart" id="bar-chart" width="800" height="600"></canvas>
            </div>
        </div>
    </div>
<?php


get_footer();
