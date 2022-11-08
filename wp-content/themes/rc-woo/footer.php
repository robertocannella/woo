
<footer>
            <div class="container">
                <div class="row">

                 <section class="footer-widgets col-9">
                    Footer Widgets
                        <div class="footer-menu">
                        <?php wp_nav_menu([
                            'theme_location' =>   'rc_woo_footer_menu'
                        ])?>
                    </div>
                   </section>
                    <section class="copyright col-3">Copyright</section>
                </div>
            </div>


</footer>
</div>
<?php   wp_footer(); ?>
</body>
</html>