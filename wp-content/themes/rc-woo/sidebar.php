<?php

/*
 * Sidebar template
 *
 * @Package RC Woo
 */
?>

<?php

if (is_active_sidebar('rc-woo-sidebar-1')):?>
    <aside class="col-lg-3 col-md-4 col-12 h-100">
   <?php dynamic_sidebar('rc-woo-sidebar-1'); ?>
    </aside>
   <?php endif;?>

