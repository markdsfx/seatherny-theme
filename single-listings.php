<?php 
/* Template Name: Listing Post Template
 * Template Post Type: post, page
 */
/**
 * Listing template
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
    $location = get_field('address');

    ?>

        <div id="main-wrapper" class="post-content">

            <div class="container-block">
                <div class="single-listings-main-wrapper">

                    <div class="left-panel">

                        <!-- Ajax Search Listings -->
                        <div id="search-form">
                            <input type="text" id="search-input" placeholder="Search...">
                            <button id="search-icon">
                                <svg focusable="false" aria-label="Search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                            </button>
                        </div>

                        <!-- Listings -->

                        <div id="loading-gif" style="display: none;">
                            <img src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/icons8-loading.gif') ?>" alt="Loading...">
                        </div>

                        <div id="ajax-posts-container">
                            <!-- Your initial listing content will be loaded here -->
                        </div>

                    </div>

                    <div class="right-panel">

                        <div class="header-content single-listings">

                            <div class="title-wrapper">

                                <h1 class="property"><?php the_title(); ?></h1>

                                <?php if ( !empty($parking) ) : ?>
                                <p class="address"><?= $location ?></p>
                                <?php endif; ?>

                                <div class="additional-information">

                                    <?php if ( !empty($parking) ) : ?>
                                    <div class="bedroom unit-info">
                                        <small><?= $bedroom ?></small>
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/bedroom-prop.png') ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($parking) ) : ?>
                                    <div class="parking unit-info">
                                        <small><?= $parking ?></small>
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/parking-prop.png') ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($sqm) ) : ?>
                                    <div class="sqm unit-info">
                                        <small><?= $sqm ?></small>
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/sqm-prop.png') ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <div class="cta-wrapper">
                                <a class="btn btn-inquire" href="#book-now">Book Now</a>
                                <p class="price">&#8369;<?= $rate ?></p>
                            </div>

                        </div>
                        
                        <?php the_content(); ?>

                        <div class="contact-inquiry-wrapper">
                            <div class="view-forms">
                                <div class="form-header">
                                    CLIENT REGISTRATION FORM
                                </div>
                                <div id="book-now" class="form-shortcode">
                                    <?php echo do_shortcode('[forminator_form id="188"]'); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            
            

        </div>

    <?php get_footer(); ?>