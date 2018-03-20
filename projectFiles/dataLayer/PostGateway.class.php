<?php
    // this class is the gateway for the post table in the database and is called when requiring information from Posts. 
    class PostGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        /* returns the detailed select statement for the Post query*/
        protected function getDetailedSelect() {    
            return  "SELECT PostID, Posts.UserID, MainPostImage, Posts.Title, Message, PostTime, ImageDetails.ImageID, Path, FirstName, LastName
                    FROM Posts";
        }
        
        /* returns the inner join text for joining imageDetails and users*/
        protected function innerJoin() {
            return " INNER JOIN ImageDetails ON MainPostImage = ImageID
                    INNER JOIN Users ON Posts.UserID = Users.UserID";        }
        
        /* returns the basic select statement for Posts */
        protected function getSelectStatement() {
            return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime
                    FROM Posts";
        }
        
        protected function relatedImagesSelect(){
            return "SELECT PostImages.PostID, PostImages.ImageID, ImageDetails.Path, ImageDetails.Title FROM PostImages";
        }
        /* used to inner join the image details on the post images image id.  */
        protected function innerJoinImages(){
            return ' INNER JOIN ImageDetails ON PostImages.ImageID = ImageDetails.ImageID';
        }
        
        /*get the ordered fields for the Posts table*/
        protected function getOrderFields()    {
            return 'PostTime';
        }
        
        /*get the key field for the Post Table. */
        protected function getKeyField() {
            return "PostID"; 
        }
        
        /* public function to get the related images from a post id. */
        public function getRelatedImages($id) {
            $sql = $this->relatedImagesSelect() . $this->innerJoinImages() . " WHERE PostImages.PostID = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
            return $statement->fetchAll();
            
        }
        
        /* public function to retrieve all of the post data for a post and orders by the newest date first. */
        public function getAllPostData() { 
            $sql = $this->getDetailedSelect() . $this->innerJoin() . " GROUP BY ". $this->getKeyField() . " ORDER BY PostTime DESC" ;
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
        
        /* public function to get a single post using the post id. */
        public function getSinglePostData($key) { 
            $sql = $this->getDetailedSelect() . $this->innerJoin(). " WHERE " .$this->getKeyField() ." = :id GROUP BY ". $this->getKeyField() . " ORDER BY PostTime DESC" ;
            $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $key));
            return $statement->fetch();
        }
    } 
?>