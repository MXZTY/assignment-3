<?php
    class FavoriteList {
        protected $img;
        protected $post;
        
        public function __construct(){
            $this->img = [];
            $this->post = [];
        }
        
        public function addFavImage($id, $path, $title){
            $this->img[$id] = array($path, $title);
        }
        
        public function deleteFavImage($id){
            unset($this->img[$id]);
        }
        
        public function addFavPost($id, $path, $title){
            $this->post[$id] = array($path, $title);
        }
        
        public function deleteFavPost($id){
             unset($this->post[$id]);
        }
        
        public function getImage(){
            return $this->img;
        }
        
        public function getPost(){
            return $this->post;
        }
        
        public function clearAll($name) {
            $this->$name = [];
            
        }
    }
?>