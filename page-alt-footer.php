<?php 
/* Template Name: Light-themed Footer Template
 * Template Post Type: post, page
 */
/**
 * Light-themed Footer template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    define('FOOTER_ALT_CLASS', true);
    get_header(); ?>

        <div id="page-content" class="page-blocks page-blocks--footer-light" data-tpl="footer-light">

            <?php 

                the_content();

            ?>
        
        </div>

    <?php get_footer(); ?>