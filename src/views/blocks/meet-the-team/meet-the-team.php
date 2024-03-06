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
    $class_name = 'block--custom-layout__meet-the-team';
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
                <h2><?php the_field('section_header')?></h2>
            </div>
        </div>

        <div class="container-block">
            <?php if( have_rows('team') ): ?>
            <div class="team-grid">
                <?php while( have_rows('team') ) : the_row();

                    $ti = get_sub_field('member_image');
                    $tn = get_sub_field('name');
                    $td = get_sub_field('descriptor');
                ?>
                <div class="grid-item">
                    <?php if( !empty( $ti ) ): ?>
                        <img class="team-rounded-img" src="<?php echo esc_url($ti['url']); ?>" />
                    <?php endif; ?>

                    <?php if ( !empty( $tn ) ) : ?>
                        <h3><?= $tn ?></h3>
                    <?php endif; ?>

                    <?php if ( !empty( $td ) ) : ?>
                        <p><?= $td ?></p>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>