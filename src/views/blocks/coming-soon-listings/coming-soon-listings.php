<?php
/**
 * Coming Soon Listings Block Template
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
    $class_name = 'block--custom-layout__coming-soon-listings';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>;">
        <div class="container-block">
            <div class="section-header">
                <?php if( get_field('section_header') ): ?>
                    <h2><?php the_field('section_header'); ?></h2>
                <?php endif; ?>
                <?php if( get_field('section_subheader') ): ?>
                    <p><?php the_field('section_subheader'); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="container-block">
            
        <?php
            $args = array(
                'post_type' => 'listings',
                'posts_per_page' => 3, // Number of posts to display
                'cat' => 1,
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) { ?>
            <div class="grid-listings">
                
                <?php while ( $query->have_posts() ) { 
                        $query->the_post();

                        $bedroom = get_field('no_of_bedroom', get_the_ID());
                        $parking = get_field('parking_slot', get_the_ID());
                        $rate = get_field('price', get_the_ID());
                    ?>
                    <div class="grid-item">
                        <img class="grid-img" src="http://localhost/seatherny/wp-content/uploads/2023/11/IMG_0434.jpg" />

                        <div class="listing-information">
                            <p class="title"><img src = "<?= \SDEV\Utils::getThemeResourcePath('assets/images/location-marker.svg') ?>" alt="My Happy SVG"/> 
                                <?php the_title(); ?>
                            </p>
                            

                            <div class="listing-details">
                                <div class="col">
                                    <a class="btn btn-inquire" href="#">Remind Me</a>
                                </div>
                                <div class="col">
                                    <p class="status">Coming Soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } else { echo 'No posts found.';  } ?>
        </div>
    </div>

<?php endif; ?>