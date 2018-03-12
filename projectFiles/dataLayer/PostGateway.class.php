<?php
    class PostGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getDetailedSelect() {    
            return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime, ImageDetails.ImageID, Path
                    FROM Posts";
        }
        
        protected function getSelectStatement() {
            return "SELECT PostID, Posts.UserID, MainPostImage, Posts.Title, Message, PostTime, ImageDetails.ImageID, Path, FirstName, LastName
                    FROM Posts
                    INNER JOIN ImageDetails ON MainPostImage = ImageID
                    INNER JOIN Users ON Posts.UserID = Users.UserID
                    GROUP BY PostID";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'PostTime';
        }
        
        protected function getKeyField() {
            return "PostID"; 
        }
        
        public function getRelatedPosts() {
            
        }
    } 
?>