<?php 
/* Template Name: 404 Template
 * Template Post Type: post, page
 */
/**
 * 404 Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    get_header(); ?>

        <div id="page-content" class="page-blocks" data-tpl="404">

            <?php 
                
                define('404_PAGE_INIT', true);
                $content = get_the_content(null, false, \SDEV\Utils::getPageId());
                echo apply_filters( 'the_content', $content );

            ?>

        </div>

    <?php get_footer(); ?>