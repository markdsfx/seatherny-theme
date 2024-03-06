<?php
/**
 * Gallery Block Template
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
    $class_name = 'block--custom-layout__gallery';
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

            
                <div id="slider" class="gallery-slider">
                    <div class="slides owl-carousel">

                        <?php

                        $video_url = get_field('video_url');


                        $video_id = '';
                        if ($video_url) {
                            parse_str(parse_url($video_url, PHP_URL_QUERY), $url_params);
                            $video_id = isset($url_params['v']) ? $url_params['v'] : '';
                        }
                        ?>


                        <?php if ($video_id): ?>
                            <div class="list-item">
                                <iframe class="feat-video" src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>


                        <?php 
                            $images = get_field('gallery_images');
                            if( $images ): ?>

                            <?php foreach( $images as $image ): ?>
                                <div class="list-item">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </div>
                            <?php endforeach; ?>
                    
                        <?php endif; ?>
                        
                    </div>
                </div>

                <div class="owl-thumbs owl-carousel">


                    <?php
                        $youtube_url = get_field('video_url');
                    ?>

                    <?php if ($youtube_url): ?>
                        <div class="owl-thumb-item">
                            <div class="yt-thumbnail">
                                <img id="customThumbnail" src="" alt="Custom Thumbnail">
                                <img class="play-icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/yt-play.png') ?>" />
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    $images = get_field('gallery_images');
                    if( $images ): 
                    
                        foreach ($images as $image) : ?>
                            <div class="owl-thumb-item">
                                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <script>
                    jQuery(document).ready(function($) {
                        // Get the YouTube video URL from PHP and update the thumbnail
                        var youtubeURL = '<?php echo esc_js($youtube_url); ?>';
                        var videoID = getYouTubeID(youtubeURL);
                        var thumbnailURL = 'https://img.youtube.com/vi/' + videoID + '/maxresdefault.jpg';

                        // Update the custom thumbnail image
                        $('#customThumbnail').attr('src', thumbnailURL);
                    });

                    // Function to extract video ID from YouTube URL
                    function getYouTubeID(url) {
                        var match = url.match(/[?&]v=([^&]+)/);
                        return match ? match[1] : null;
                    }
                </script>
            
        </div>
    </div>

<?php endif; ?>