<?php 
/* Template Name: Single Post Template
 * Template Post Type: post, page
 */
/**
 * Single Post Default template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    get_header(); 
    
    $bedroom = get_field('no_of_bedroom');
    $parking = get_field('parking_slot');
    $sqm = get_field('sqm');
    $rate = get_field('price');

    ?>


        <div id="main-wrapper" class="post-default">



            <div class="container-block">
                <div class="header-content">

                    <div class="title-wrapper">
                        <h1><?php the_title(); ?></h1>
                        <p>Posted on: <?php the_time( 'F jS Y' ); ?></p>
                    </div>

                </div>
            </div>

            <div class="container-block">
                <div class="single-default-content">
                    <?php the_content(); ?>
                </div>
            </div>
            
        </div>

    <?php get_footer(); ?>

