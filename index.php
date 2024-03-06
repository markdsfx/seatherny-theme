<?php 
/* Template Name: Default Template
 * Template Post Type: post, page
 */
/**
 * Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    get_header(); ?>

        <div id="page-content" class="page-blocks" data-tpl="index">

            <?php 

                the_content();

            ?>
        
        </div>

    <?php get_footer(); ?>