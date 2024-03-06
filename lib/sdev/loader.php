<?php
    /**
     *  Loader Class
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */

    namespace SDEV;

    class Loader{

        public static function loadDependencies(Array $di){

            foreach($di as $dir => $dep){

                $dir = ($dir == 'core') ? '' : rtrim($dir, '/').'/';
                if(is_array($dep)){
                    foreach($dep as $f){
                        $file = $dir.(preg_replace("/\.php$/","",$f)).'.php';
                        self::loadFile($file);
                    }
                } else {
                    $file = $dir.(preg_replace("/\.php$/","",$dep)).'.php';
                    self::loadFile($file);
                }
            }

        }

        public static function loadFile($file){
            if(include($file)){
                return true;
            } else {
                throw new \Exception('SDEV Dependency not found. File not found : '.$file);
            }
            return false;
        }

    }

?>