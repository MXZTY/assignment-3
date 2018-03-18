<?php
    class PostGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getDetailedSelect() {    
            return  "SELECT PostID, Posts.UserID, MainPostImage, Posts.Title, Message, PostTime, ImageDetails.ImageID, Path, FirstName, LastName
                    FROM Posts";
        }
        
        protected function innerJoin() {
            return " INNER JOIN ImageDetails ON MainPostImage = ImageID
                    INNER JOIN Users ON Posts.UserID = Users.UserID";        }
        
        protected function getSelectStatement() {
            return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime
                    FROM Posts";
        }
        
        protected function relatedImagesSelect(){
            return "SELECT PostImages.PostID, PostImages.ImageID, ImageDetails.Path, ImageDetails.Title FROM PostImages";
        }
        
        protected function innerJoinImages(){
            return ' INNER JOIN ImageDetails ON PostImages.ImageID = ImageDetails.ImageID';
        }
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'PostTime';
        }
        
        protected function getKeyField() {
            return "PostID"; 
        }
        
        public function getRelatedImages($id) {
            $sql = $this->relatedImagesSelect() . $this->innerJoinImages() . " WHERE PostImages.PostID = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
            return $statement->fetchAll();
            
        }
        
        public function getAllPostData() { 
            $sql = $this->getDetailedSelect() . $this->innerJoin() . " GROUP BY ". $this->getKeyField() ;
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
        
        public function getSinglePostData($key) { 
            $sql = $this->getDetailedSelect() . $this->innerJoin(). " WHERE " .$this->getKeyField() ." = :id GROUP BY ". $this->getKeyField();
            $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $key));
            return $statement->fetch();
        }
    } 
?>