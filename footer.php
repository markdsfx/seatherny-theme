<?php
/**
 * Footer template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    $footer_class = 'page-footer';
    $footer_class .= (defined('FOOTER_ALT_CLASS')) ? ' page-footer--alt' : '';
?>



        <footer id="page-footer" class="<?= $footer_class ?>">
            <?php 
                get_template_part('src/views/partials/footer', 'upper');  
            ?>
        </footer>

        <footer id="page-footer" class="<?= $footer_class ?> footer-lower">
            <?php get_template_part('src/views/partials/footer', 'lower'); ?>
        </footer>
    </div> <!-- page main wrapper -->
    <div class="non_visual_wrapper opt__step">
        <?php get_template_part('src/views/partials/footer', 'body-end'); ?>
        <?php wp_footer(); ?>
    </div>
</body>
</html>