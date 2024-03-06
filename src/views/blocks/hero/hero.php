<?php
/**
 * Hero Block Template
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

    $heroBG = get_field('background_image');
    $heroHeader = get_field('banner_header');
   

    // Create class attribute allowing for custom "className" and "align" values.
    $class_name = 'block--custom-layout__hero';
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

    <div class="block--custom-layout <?= $class_name ?>" <?= $anchor ?> style="background-color:<?= $background ?>; background-image: url('<?php echo esc_url($heroBG['url']); ?>'); ">
        <div class="bg-overlay">
            <div class="container-block">
                <div class="inner-container">
                    
                    <h1><?= $heroHeader ?></h1>
                    <?php 
                    $heroCTA = get_field('banner_cta_link');
                    if( $heroCTA ): 
                        $link_url = $heroCTA['url'];
                        $link_title = $heroCTA['title'];
                        $link_target = $heroCTA['target'] ? $heroCTA['target'] : '_self';
                    ?>
                    <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>