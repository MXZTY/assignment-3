<?php
    class UserGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        /*Select statement to retrieve the basic user information*/
        protected function getSelectStatement() {    
            return "SELECT UserID, FirstName, LastName, Address, City, 
                            Region, Country, Postal, Phone, Email, Privacy
                    FROM Users";
        }
        
        /*Select statement to retrieve the user login information*/
        protected function getLoginSelectStatement() {    
            return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified
                    FROM UsersLogin";
        }
        
        protected function getOrderFields()    {
            return 'FirstName, LastName';
        }
        
        protected function getKeyField() {
            return "UserID"; 
        }
        
        /*This function takes in a password adds the salt and comapirs to the encrypted password*/
        protected function validateLogin($row, $password){
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
        
        /*Login function which queries the db for username, salt, and encrypted password to validate the user
            Returns either 'error' or the user id for use in the SESSION*/
        public function login($userName, $password){
            $sql = $this->getLoginSelectStatement() . " WHERE UserName = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $userName));
            $row = $statement->fetch();
                return $this->validateLogin($row, $password);
        }
    } 
?>