<?php
/**
 * Interior Features Block Template
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
    $class_name = 'block--custom-layout__interior-features';
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
                    <h2>Interior Features</h2>
                </div>

                <?php 
                $feats = get_field('interior_features'); 
                if( $feats ):
                ?>
                <div class="features-wrapper">
                    <ul class="list-inline">
                        <?php foreach( $feats as $feat ): ?>
                            <li class="feature-<?php echo $feat['value']; ?>"><?php echo $feat['label']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

        </div>
    </div>

<?php endif; ?>