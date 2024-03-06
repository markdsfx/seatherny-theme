<?php 
/**
 * ACF Blocks Registry
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    function register_acf_blocks() {

        // Add your ACF Blocks here
        $acf_blocks = [
            'hero',
            'wysiwyg',
            'featured-listings',
            'coming-soon-listings',
            'search-listings',
            'rented-properties-listings',
            'meet-the-team',
            'gallery',
            'map',
            'floor-plans',
            'description',
            'interior-features',
            'blogs',
            'about-core-values',
            'about-mission-vision',
            'enlist-your-property'
        ];

        foreach($acf_blocks as $block){
            register_block_type( __DIR__ . '/' . $block );
        }
        
    }

    function register_layout_category( $categories ) {
        
        array_unshift($categories, [
            'slug'  => 'custom-layout',
            'title' => 'Custom Layout'
        ]);

        return $categories;
    }

    
    if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
        add_filter( 'block_categories_all', 'register_layout_category' );
    } else {
        add_filter( 'block_categories', 'register_layout_category' );
    }

    add_action( 'init', 'register_acf_blocks' );