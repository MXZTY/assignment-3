<?php
    class UserGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT UserID, FirstName, LastName, Address, City, 
                            Region, Country, Postal, Phone, Email, Privacy
                    FROM Users";
        }
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'FirstName, LastName';
        }
        
        protected function getKeyField() {
            return "UserID"; 
        }
    } 
?>