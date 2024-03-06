<?php
    /**
     *  SDEV Utiliy functions
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 1.0
     */

    namespace SDEV;

    class Utils{

        public static function getRequest($key = '', $method = 'request', $data = false){
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

        public static function resizeImage($resource, $options = array()){
            $w = (isset($options['w'])) ? $options['w'] : 150;
            $h = (isset($options['h'])) ? $options['h'] : 150;
            $q = (isset($options['q'])) ? $options['q'] : 95;
            
            $path = self::getThemeResourcePath('resizer.php').'?src='.$resource.'&w='.$w.'&h='.$h.'&q='.$q;
            return $path;
        }

        public static function getThemeResourcePath($resource){
            return get_template_directory_uri().'/'.ltrim($resource,'/');
        }

        public static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
            $sort_col = array();
            foreach ($arr as $key=> $row) {
                $sort_col[$key] = $row[$col];
            }
            array_multisort($sort_col, $dir, $arr);
        }
        
        public static function getPageId(){
            global $wp_query;
            if(is_post_type_archive()){
                $wquery = $wp_query->query;
                $post_type = $wquery['post_type'];
                $pages = get_pages(array(
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'archive-'.$post_type.'.php'
                ));
                if(!$pages){
                    $pages = get_pages(array(
                        'meta_key' => '_wp_page_template',
                        'meta_value' => 'archive.php'
                    ));
                }
                foreach($pages as $page){
                    return $page->ID;
                    break;
                }
            }
            if(is_404() || defined('404_PAGE_INIT')){
                $pages = get_pages(array(
                    'meta_key' => '_wp_page_template',
                    'meta_value' => '404.php',
                    'post_status' => 'private'
                ));
                foreach($pages as $page){
                    return $page->ID;
                    break;
                }
            }
            if(defined('SEARCH_PAGE_INIT')){
                $pages = get_pages(array(
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'search.php'
                ));
                foreach($pages as $page){
                    return $page->ID;
                    break;
                }
            }
            return get_post()->ID;
        }

        public static function getMenuItems($menu = 'Main Menu', $format = false){
            if($format){
                $menu_items = wp_get_nav_menu_items($menu);
                $last_parent = 0; 
                $m_count = 0;
                $final_menu_items = array(); 
                $sub_menu_items = array();
                foreach($menu_items as $menu_item) {
                    if($menu_item->menu_item_parent == 0) {
                        if($last_parent != 0){
                            $last_parent = 0;
                        }
                        $final_menu_items[$m_count] = array('item' => $menu_item, 'submenu' => array());
                        $m_count++;
                    } else {
                        if($last_parent == 0){ $last_parent = $menu_item->menu_item_parent; }
						array_push($final_menu_items[$m_count-1]['submenu'], $menu_item);
                    }
                }
                return $final_menu_items;
            } else {
                return wp_get_nav_menu_items($menu);
            }
        }
        
        public static function getMenuItemClass($curr_url, $item_url, $class = 'nav-item', $active_class = 'nav-active'){
            if (strpos($curr_url, $item_url) !== false) {
                $class .= ' '.$active_class;
            } 
            return $class;
        }

    }