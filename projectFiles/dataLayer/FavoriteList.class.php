<?php
    /*This class encapsulates the users favorites by providing an array of image data and post data which 
        will contain the path and title of the image/post. */
    class FavoriteList {
        
        protected $img;
        protected $post;
        
        public function __construct(){
            $this->img = [];
            $this->post = [];
        }
        
        /*Add image function takes in an id, a image path, and the image title of the image that will be added*/
        public function addFavImage($id, $path, $title){
            $this->img[$id] = array($path, $title);
        }
        
        /*Delete image function takes in an id value of the specific image that will be removed*/
        public function deleteFavImage($id){
            unset($this->img[$id]);
        }
        
        /*Add  post function takes in an id, a file path, and a file title of the post that will be added*/
        public function addFavPost($id, $path, $title){
            $this->post[$id] = array($path, $title);
        }
        
        /*Delete post function takes in an id value of the specific post that will be removed*/
        public function deleteFavPost($id){
             unset($this->post[$id]);
        }
        
        /*Getters for the image and post array for access to inner information*/
        public function getImage(){
            return $this->img;
        }
        
        public function getPost(){
            return $this->post;
        }
        
        /*Delete a specified array (Either post or img) determined by a passed in variable $name*/
        public function clearAll($name) {
            $this->$name = [];
            
        }
    }
?>