<?php 
    class UserLoginGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified
                    FROM UsersLogin";
        }
        
        protected function validateUser() {
            return "SELECT UserName FROM UsersLogin";
        }
        
        protected function getKeyField() {
            return "UserID"; 
        }
        
        protected function getOrderFields()    {
            return 'UserName';
        }
        
        protected function validateLogin($userName, $password){
            $sql = $this->getSelectStatement() . " WHERE UserName = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $userName));
            $row = $statement->fetch();
            if($row['UserID'] == null){
                return 'error';
            } else {
                if( md5($password.$row['Salt']) == $row['Password']){
                    return $row['UserID'];
                } else {
                    return 'error';
                }
                
            }
        }
        
        public function login($userName, $password){
            $sql = $this->validateUser() . " WHERE UserName = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $userName)); 
            if($statement->fetch() == null){
                return 'error';
            } else {
                return $this->validateLogin($userName, $password);
            }
        }
        
        
    }
?>