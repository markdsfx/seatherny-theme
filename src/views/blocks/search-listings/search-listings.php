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
    $class_name = 'block--custom-layout__search listings';
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

        <div id="left-panel">
    <?php
    $args = array(
        'post_type' => 'listings',
        'posts_per_page' => -1,
    );

    $posts = new WP_Query($args);

    if ($posts->have_posts()) :
        while ($posts->have_posts()) : $posts->the_post();
    ?>
            <div class="post-title" data-post-id="<?php echo get_the_ID(); ?>">
                <?php the_title(); ?>
            </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;
    ?>
</div>

<div id="right-panel">
    <!-- Content will be displayed here via Ajax -->
</div>

        </div>
    </div>

<script>
    jQuery(document).ready(function($) {
        // Ajax request when a post title is clicked
        $('.post-title').on('click', function() {
            var post_id = $(this).data('post-id');

            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: {
                    action: 'get_post_content',
                    post_id: post_id
                },
                success: function(response) {
                    // Display the content in the right panel
                    $('#right-panel').html(response);
                }
            });
        });
    });
</script>

<?php endif; ?>