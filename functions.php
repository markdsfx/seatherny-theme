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


    function my_theme_scripts() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'my-ajax-pagination', \SDEV\Utils::getThemeResourcePath('dist/ajax-pagination.js'), array( 'jquery' ), '1.0', true );
        wp_enqueue_style( 'my-ajax-pagination', \SDEV\Utils::getThemeResourcePath('dist/ajax-pagination.css'), array(), '1.0' );
    
        // Localize the required data
        $ajax_data = array(
            'ajax_url' => admin_url( 'admin-ajax.php' ), // WordPress AJAX URL
            // Add any other data you need to pass to the JavaScript file
        );
        wp_localize_script( 'my-ajax-pagination', 'my_ajax_obj', $ajax_data );
    }
    add_action( 'wp_enqueue_scripts', 'my_theme_scripts' );

    function my_ajax_pagination() {
        $paged = isset($_POST['paged']) ? $_POST['paged'] : 1; // Get the current page number
    
        $args = array(
            'post_type' => 'listings', // Change this to your desired post type
            'posts_per_page' => 1, // Number of posts to display per page
            'paged' => $paged
        );
    
        $query = new WP_Query($args);
    
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Output your post listing HTML here
                the_title();
            }
    
            // Output the pagination links
            $max_pages = $query->max_num_pages;
            $current_page = max(1, $paged);
    
            echo '<div class="nav-links">';
            echo get_previous_posts_link('Previous', $query->max_num_pages);
            echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $max_pages,
                'prev_next' => true,
                'prev_text' => 'Previous',
                'next_text' => 'Next'
            ));
            echo '</div>';
    
            // Output a placeholder for the maximum number of pages
            echo "<input type='hidden' id='max_pages' value='$max_pages'>";
        }
    
        wp_reset_postdata();
        die();
    }
    add_action('wp_ajax_my_ajax_pagination', 'my_ajax_pagination');
    add_action('wp_ajax_nopriv_my_ajax_pagination', 'my_ajax_pagination');

?>