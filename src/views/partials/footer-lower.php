<?php
/**
 * Footer Lower Template (Footer Block)
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  
    $footer_logo = get_field('footer_logo_image', 'options');

?>
<div class="pf-lower container-block">
    <div class="copyright">
        <?= get_field('copyright_line', 'options') ?>
    </div>

    <div class="social-links-menu">

        <a href="#" target="_blank">
            <i class="fab fa-tiktok"></i>
        </a>
        
        <?php if(!empty(get_field('sl_instagram', 'options'))) : ?>
            <a href="<?= get_field('sl_instagram', 'options') ?>" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif; ?>
        
        <?php if(!empty(get_field('sl_twitter', 'options'))) : ?>
            <a href="<?= get_field('sl_twitter', 'options') ?>" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif; ?>
        
        <?php if(!empty(get_field('sl_youtube', 'options'))) : ?>
            <a href="<?= get_field('sl_youtube', 'options') ?>" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif; ?>
        
        <?php if(!empty(get_field('sl_linked_in', 'options'))) : ?>
            <a href="<?= get_field('sl_linked_in', 'options') ?>" target="_blank">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif; ?>

        <?php if(!empty(get_field('sl_facebook', 'options'))) : ?>
            <a href="<?= get_field('sl_facebook', 'options') ?>" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>
        <?php endif; ?>

    </div>
</div>