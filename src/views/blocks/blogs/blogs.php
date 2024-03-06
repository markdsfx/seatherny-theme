<?php
/**
 * Blogs Listings Block Template
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
    $class_name = 'block--custom-layout__blogs';
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
            <div class="block-header">
                <h2><?php the_field('section_header')?></h2>
            </div>
        </div>

        <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $paged,
            );

            $query = new WP_Query($args);
        ?>
        

        <div class="container-block">
            <?php if ($query->have_posts()) : ?>
            <div class="blogs-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="grid-item">
                    <a class="grid-permalink" href="<?php the_permalink(); ?>">
                        <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($query->ID) ); ?>
                        
                        <?php if ( !empty($feat_image) ) : ?>
                        <img class="blog-feat-img" src="<?php echo $feat_image ?>" />
                        <?php endif; ?>

                        <h3><?php the_title(); ?></h3>
                        <p><?php the_time( 'F jS Y' ); ?></p>
                    </a>
                </div>
                <?php endwhile;

                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Previous', 'textdomain'),
                    'next_text' => __('Next &raquo;', 'textdomain'),
                ));
                
                ?>
            </div>
            <?php else : ?>

                <p>No posts found.</p>

            <?php endif; wp_reset_postdata(); ?>
        </div>

        

    </div>

<?php endif; ?>