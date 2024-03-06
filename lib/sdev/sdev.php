<?php
    /**
     *  SDEV Bootstrap file
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */
    
    if( function_exists('acf_add_options_page') ) {
        $parent = acf_add_options_page(
            array(
                'page_title' => 'Theme Settings',
                'menu_slug' => 'acf-options',
                'redirect'    => false,
                'icon_url' => 'dashicons-layout'
            )
        );
    }

    require_once('loader.php');
    require_once('etc/di.php');

    try{

        \SDEV\Loader::loadDependencies($sdev_di);

        $ajax_controller = new \SDEV\Controller\Ajax();
        $ajax_controller->registerActions();

    } catch (\Exception $e){

        exit($e->getMessage());
        
    }

?>