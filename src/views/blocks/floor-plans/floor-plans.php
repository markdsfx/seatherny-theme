<?php
/**
 * Floor Plans Block Template
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
    $class_name = 'block--custom-layout__floor-plans';
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
                <h2>See Layout/Floor Plans</h2>
            </div>
            <?php 
            $images = get_field('floor_plans');
            if( $images ): ?>
                <div class="floor-plans-wrapper">
                    <?php foreach( $images as $image ): ?>
                        <div class="floor-item">
                            <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endforeach; ?>

                    <div class="expand-btn" id="expandBtn">Expand</div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>

<?php endif; ?>

<script>
  jQuery(document).ready(function($) {
    // Show the first child div initially
    $(".floor-item:first").show();

    // Toggle visibility of all child divs (except the first) on button click with fade effect
    $("#expandBtn").on("click", function() {
      $(".floor-item:not(:first)").fadeToggle();
    });
  });
</script>