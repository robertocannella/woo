
<footer>
     <section class="footer-widgets">
            <div class="container">
                <div class="row">Footer Widgets</div>
            </div>
     </section>
        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="copyright-text col-12 col-md-6">Copyright</div>
                    <nav class="footer-menu col-12 col-md-6 text-start text-md-end">
                        <?php wp_nav_menu([
                            'theme_location' =>   'rc_woo_footer_menu'
                        ])?>

                    </nav>
                </div>
            </div>
   </section>
</footer>
</div>
<?php   wp_footer(); ?>
</body>
</html>