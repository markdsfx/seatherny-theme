<?php
/**
 * WYSIWYG Block Template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */  

    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Get acf fields value and set default
    $theme = get_field('theme') ?: 'light';
    $background = get_field('background_color') ?: '#FFFFFF';
    $content = get_field('content');

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__featured-listings';
    if ( ! empty( $block['className'] ) ) {
        $class_name .= ' ' . $block['className'];
    }
    if ( ! empty( $block['align'] ) ) {
        $class_name .= ' align' . $block['align'];
    }

    $class_name .= ' block-theme-'.$theme;

    // Show preview image in preview mode
    if(get_field('preview_image')) :

        echo '<img src="'.\SDEV\Utils::getThemeResourcePath('src/views/blocks/').get_field('preview_image').'" style="width: 100%;" />';

    else :
?>

    <div id="featured-listings" class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">

        <div class="container-block">
            <div class="featured-listings-header text-center">
                <?php if( get_field('section_header') ): ?>
                    <h2><?php the_field('section_header'); ?></h2>
                <?php endif; ?>
                <?php if( get_field('section_subheader') ): ?>
                    <p><?php the_field('section_subheader'); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="container-block">
            <div class="search-form-wrapper">
                <?php echo do_shortcode( '[ivory-search id="194"]' ); ?>
            </div>
        </div>

        <div class="container-block">
            
        <?php
            $args = array(
                'post_type' => 'listings',
                'posts_per_page' => -1, // Number of posts to display
                'exclude' => array(5,3)
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) { ?>
                <div class="grid-item-wrapper owl-carousel owl-theme">
                    

                    <?php 
                        $counter = 0;
                        while ( $query->have_posts() ) { 
                            $query->the_post();

                            $bedroom = get_field('no_of_bedroom', get_the_ID());
                            $parking = get_field('parking_slot', get_the_ID());
                            $sqm = get_field('sqm', get_the_ID());
                            $rate = get_field('price', get_the_ID());
                            $unitCode = get_field('code', get_the_ID());

                            if ($counter % 6 == 0) {
                                // Close the current container after every 3 items (except for the first one)
                                if ($counter != 0) {
                                    echo '</div> </div>';
                                }
                                // Open a new container
                                echo '<div class="list-item"> <div class="grid-listings">';
                            }
                        ?>
                        <div class="grid-item">

                            <?php $url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' ); ?>

                            <a href="<?php the_permalink(); ?>">
                                <?php if ( !empty($url) ) : ?>
                                    <img class="grid-img" src="<?php echo $url ?>" />
                                <?php else : ?>
                                    <img class="grid-img" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.jpg') ?>" />
                                <?php endif; ?>
                            </a>

                            <div class="listing-information">
                                <a href="<?php the_permalink(); ?>">
                                <div class="listing-header">
                                    <div class="title">
                                        <img height="20" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/location-marker.svg') ?>" alt="My Happy SVG"/> 
                                        <?php the_title(); ?>
                                    </div>
                                    <p class="unit-code"><?= $unitCode; ?></p>
                                </div>
                                </a>
                                
                                <div class="additional-information">

                                    <?php if ( !empty($parking) ) : ?>
                                    <div class="bedroom unit-info">
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/bedroom-prop.png') ?>">
                                        <small><?= $bedroom ?></small>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($parking) ) : ?>
                                    <div class="parking unit-info">
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/parking-prop.png') ?>">
                                        <small><?= $parking ?></small>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ( !empty($sqm) ) : ?>
                                    <div class="sqm unit-info">
                                        <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/sqm-prop.png') ?>">
                                        <small><?= $sqm ?></small>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="listing-details">
                                    <div class="col">
                                        <a class="btn btn-inquire" href="<?php the_permalink(); ?>">Inquire Now</a>
                                    </div>

                                    <?php if ( !empty($rate) ) : ?>
                                    <div class="col">
                                        <p class="price">&#8369;<?= $rate ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $counter++;
                        } // endwhile loop 
                        
                        if ($counter % 6 != 0) {
                            echo '</div> </div>';
                        }
                        ?>
                </div>
            <?php 
                } else { 
                    echo 'No posts found.'; 
                } 
                wp_reset_postdata(); ?>
        </div>
            </div>


    </div>



<?php endif; ?>