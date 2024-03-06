<?php
    /**
     *  SDEV Query Helper Class
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */

    namespace SDEV\Helper;

    class Query{

        protected $query;
        protected $meta_query = array();
        protected $tax_query = array();
        protected $query_args = array();
        protected $filters = array();
        protected $initial_posts = array();
        protected $filtered_posts = array();
        protected $final_posts = array();
        protected $page = 1;
        protected $page_size = 20;
        protected $result_size = 0;
        protected $total_pages = 1;
        protected $additional = array();
        protected $meta_fields = array();

        
        public $post_type = 'post';
        public $taxonomy = 'category';

        public function __construct(){
            $this->query = false;
            if(!empty($_GET)){
                foreach($_GET as $k => $v){
                    if(!is_array($v)){
                        $this->filters[$k] = urldecode($v);
                    }
                }
            }
        }

        public function setQueryArgs(Array $args){
            $this->query_args = $args;
            return $this;
        }

        public function setMetaFields(Array $meta_fields){
            $this->meta_fields = $meta_fields;
            return $this;
        }

        public function getQuery(){
            return $this->query;
        }

        public function getQueryArgs(){
            return $this->query_args;
        }
        
        public function setMetaQuery(Array $meta_query){
            $this->query_args['meta_query'] = $meta_query;
            return $this;
        }

        public function setTaxQuery(Array $tax_query){
            $this->query_args['tax_query'] = $tax_query;
            return $this;
        }

        public function setOrder($orderby, $order){
            $this->query_args['orderby'] = $orderby;
            $this->query_args['order'] = $order;
            return $this;
        }

        public function setSearch($search){
            $this->query_args['s'] = $search;
            return $this;
        }

        public function runQuery(){
            $this->query = new \WP_Query( $this->query_args );
            if($this->query){
                $this->initial_posts = $this->query->posts;
            }
            return $this;
        }

        public function setFilter($k, $v = ''){
            if(is_array($k)){
                $this->filters = $k;
            } else {
                $this->filters[$k] = $v;
            }
            return $this;
        }

        public function getFilter($key = false){
            if($key){
                return (isset($this->filters[$key])) ? $this->filters[$key] : false;
            }
            return $this->filters;
        }

        public function setPage($page){
            $this->query_args['page'] = $page;
            $this->page = $page;
            return $this;
        }

        public function setPageSize($page_size){
            $this->query_args['posts_per_page'] = $page_size;
            $this->page_size = $page_size;
            return $this;
        }

        public function getPageSize(){
            return $this->page_size;
        }

        public function getResultSize(){
            return $this->result_size;
        }

        public function getTotalPages($refresh_list = false){
            if($refresh_list){
                $this->getFinalList();
            }
            return $this->total_pages;
        }

        public function getCategories($exclude_uncategorised = true, $orderby = 'name', $order = 'ASC'){

            $categories = array();
            
            $terms = get_terms(array(
                'taxonomy' => $this->taxonomy,
                'orderby' => $orderby,
                'order' => $order,
                'hide_empty' => false
            ) );

            foreach($terms as $t){
                if($exclude_uncategorised){
                    if($t->slug != 'uncategorised' && $t->slug != 'uncategorized'){
                        $categories[] = $t;
                    }
                } else {
                    $categories[] = $t;
                }
            }

            return $categories;
        }

        public function getList($final_list = false){

            $this->runQuery();
            $list = $this->initial_posts;
            
            if(!empty($list)){
                if($final_list){
                    foreach($list as $i){
                        $this->filtered_posts[] = $i;
                    }
                    $list = $this->getFinalList();
                }
            }

            return $list;

        }

        public function getFinalList(){
            $start_index = $this->page_size * ($this->page  - 1);
            $end_index = $start_index + ($this->page_size - 1);
            $this->result_size  = sizeOf($this->filtered_posts);
            if($this->result_size  > 0){
                for($i=$start_index; $i<= $end_index; $i++){
                    if(isset($this->filtered_posts[$i])){
                        $this->final_posts[] = $this->filtered_posts[$i];
                    }
                    if($i > $this->result_size ){
                        break;
                    }
                }
                $this->total_pages = ceil($this->result_size / $this->page_size);
            }
            return $this->final_posts;
        }

    }

?>