<?php
/**
 * About Core Values Block Template
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
    $class_name = 'block--custom-layout__about-core-values';
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

            <div class="page-header-section">
                <h1><?php the_field('section_title'); ?></h1>
            </div>

            <?php 
            if( have_rows('core_values') ): ?>
            <div class="grid-values">
                <?php while( have_rows('core_values') ) : the_row(); ?>

                <div class="text-column">
                    <h2><?php the_sub_field('title'); ?></h2>
                    <p><?php the_sub_field('descriptor', false, false); ?></p>
                </div>

                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            
        </div>
    </div>

<?php endif; ?>