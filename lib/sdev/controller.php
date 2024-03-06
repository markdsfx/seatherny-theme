<?php
    /**
     *  SDEV Controller Parent Class
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */

    namespace SDEV;

    class Controller{

        protected $request;
        protected $post;
        protected $get;

        public function __construct(){
            $this->request = $_REQUEST;
            $this->post = $_POST;
            $this->get = $_GET;
        }

        public function getRequest($key = '', $method = 'request', $data = false){
            switch($method){
                case 'post':
                    $data = ((isset($this->post[$key])) 
                        ? $this->post[$key] 
                        : (($key) ? false : $this->post));
                    break;
                
                case 'get':
                    $data = ((isset($this->get[$key])) 
                        ? $this->get[$key] 
                        : (($key) ? false : $this->get));
                    break;

                default:
                    $data = ((isset($this->request[$key])) 
                        ? $this->request[$key] 
                        : ((!$key) ? $this->request : false));
                    break;
            }
            return $data;
        }

    }

?>