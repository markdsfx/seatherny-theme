<?php
    /**
     * Functions.php
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since SDEV WP Theme 2.0
     */
    if(!isset($_SESSION)){
        session_start();
    }
    define('DEV_ENV', 1);

    /* Show errors if DEV_ENV is set to 1 */
    if(DEV_ENV === 0){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    
    /* remove "Private: " from titles */
    function remove_private_prefix($title) {
        $title = str_replace('Private: ', '', $title);
        return $title;
    }
    add_filter('the_title', 'remove_private_prefix');

    /* remove p tag wrap in images */
    function filter_ptags_on_images($content) {
        $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
        return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
    }
    add_filter('acf_the_content', 'filter_ptags_on_images');
    add_filter('the_content', 'filter_ptags_on_images');

    /* Add theme support for plugin features */
    add_theme_support( 'title-tag' );
    add_theme_support( 'yoast-seo-breadcrumbs' );
    function my_theme_setup(){
        add_theme_support('post-thumbnails');
    }
    
    add_action('after_setup_theme', 'my_theme_setup');
    /* SDEV Bootstrap */
    require_once('lib/sdev/sdev.php');

    /* Register ACF Blocks */
    require_once('src/views/blocks/register.php');

    /* Register theme assets */
    wp_register_style( 'google-fonts', 'https://use.typekit.net/mni3ffg.css' );
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css' );
    wp_register_style( 'reset-css', \SDEV\Utils::getThemeResourcePath( 'assets/css/reset.css' ) );
    wp_register_style( 'sdev-theme-style', \SDEV\Utils::getThemeResourcePath( 'dist/style.css' ), array(), rand(111,9999), 'all' );
    wp_register_script( 'sdev-theme-script', \SDEV\Utils::getThemeResourcePath( 'dist/bundle.js' ), array('jquery'), rand(111,9999), true );

    /* Enqueue FE assets */
    function front_assets(){
        wp_enqueue_style( 'reset-css' );
        wp_enqueue_style( 'sdev-theme-style' );
        wp_enqueue_script( 'sdev-theme-script' );
        wp_enqueue_style( 'google-fonts');
        wp_enqueue_style( 'fontawesome');
    }

    /* Enqueue admin assets */
    function custom_admin_assets(){
        /* So our FE fonts and styles will reflect in admin acf block editor and there's no need to add stylesheet in each block. */
        wp_enqueue_style( 'google-fonts');
        wp_enqueue_style( 'sdev-theme-style' );
    }

    /* Hook them */
    add_action( 'wp_enqueue_scripts', 'front_assets' );
    add_action( 'admin_enqueue_scripts', 'custom_admin_assets' );
    register_sidebar();


    function my_acf_init() {
        acf_update_setting('google_api_key', 'AIzaSyBrcbRGHEFykeZwXW9edATIkRRQkBrWmXU');
    }
    add_action('acf/init', 'my_acf_init');



    function enqueue_ajax_related_listings_script() {
        wp_enqueue_script('ajax-related-listings', get_template_directory_uri() . '/path/to/ajax-related-listings.js', array('jquery'), null, true);
        wp_localize_script('ajax-related-listings', 'ajaxurl', admin_url('admin-ajax.php'));
    }
    
    add_action('wp_enqueue_scripts', 'enqueue_ajax_related_listings_script');


    function load_related_listings_ajax() {
        $posts_per_page = -1;
        $current_post_id = (is_singular()) ? get_the_ID() : 0;
    
        $args = array(
            'post_type' => 'listings',
            'posts_per_page' => $posts_per_page,
            'paged' => $_POST['page'],
            'cat' => '3',
            's' => sanitize_text_field($_POST['search'])
        );
    
        $query = new WP_Query($args);
    
        ob_start();
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();

                // Display your listing content here ?>
                <a href="<?php the_permalink(); ?>" class="listing-link">
                    <div class="list-item item-<?php the_ID(); ?>" >
                        <div class="list-details">
                            <div class="listing-name">
                                <p class="title"><?php the_title(); ?></p>
                                <?php 
                                    $unit_code = get_post_meta(get_the_ID(), 'code', true); 
                                    if ( !empty($unit_code) ) : ?>
                                    <span class="unit-code"><?= $unit_code ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="additional-information">
                                <?php 
                                $bedroom = get_post_meta(get_the_ID(), 'no_of_bedroom', true);
                                if ( !empty($bedroom) ) : ?>
                                <div class="bedroom unit-info">
                                    <small><?= $bedroom ?></small>
                                    <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/bedroom-prop.png') ?>">
                                </div>
                                <?php endif; ?>

                                <?php 
                                $parking = get_post_meta(get_the_ID(), 'parking_slot', true);
                                if ( !empty($parking) ) : ?>
                                <div class="parking unit-info">
                                    <small><?= $parking ?></small>
                                    <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/parking-prop.png') ?>">
                                </div>
                                <?php endif; ?>

                                <?php 
                                $sqm = get_post_meta(get_the_ID(), 'sqm', true);
                                if ( !empty($sqm) ) : ?>
                                <div class="sqm unit-info">
                                    <small><?= $sqm ?></small>
                                    <img class="icon" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/sqm-prop.png') ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="listing-rate">
                                <?php 
                                    $rate = get_post_meta(get_the_ID(), 'price', true); 
                                    if ( !empty($rate) ) : ?>
                                    <span><?= $rate ?></span>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                        <div class="listing-featured-image">
                            <?php $url = wp_get_attachment_url( get_post_thumbnail_id(), 'thumbnail' ); ?>

                            <?php if ( !empty($url) ) : ?>
                                <img class="grid-img" src="<?php echo $url ?>" />
                            <?php else : ?>
                                <img class="grid-img" src="<?= \SDEV\Utils::getThemeResourcePath('assets/images/placeholder.jpg') ?>" />
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endwhile;
    
        echo '<div class="numeric-pagination">';
        $pagination_args = array(
            'total' => $query->max_num_pages,
            'current' => max(1, $_POST['page']),
            'mid_size' => 3,

        );
        
        echo paginate_links($pagination_args);
        echo '</div>';


    
            wp_reset_postdata();
        else :
            echo 'No more listings';
        endif;
    
        $response = ob_get_clean(); // Get the captured HTML

        echo $response;
        die();
    }
    
    add_action('wp_ajax_load_related_listings', 'load_related_listings_ajax');
    add_action('wp_ajax_nopriv_load_related_listings', 'load_related_listings_ajax');

?>