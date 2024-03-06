<?php
    /**
     *  Ajax Controller
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */

    namespace SDEV\Controller;

    class Ajax extends \SDEV\Controller implements \SDEV\Interfaces\WPXHRActionControllerInterface {

        public function __construct(){
            parent::__construct();    
        }

        public function registerActions(){
            add_action( 'wp_ajax_post_load_more', array($this, 'loadMore') );
            add_action( 'wp_ajax_nopriv_post_load_more', array($this, 'loadMore') );
        }
        
        public function loadMore(){

            $data = array(
                'success' => false,
                'message' => 'Bad Request',
                'code' => 400
            );

            echo json_encode($data);
            exit;

        }

    }

?>