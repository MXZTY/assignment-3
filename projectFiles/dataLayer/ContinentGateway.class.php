<?php
    class ContinentGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT Continents.ContinentCode, ContinentName FROM Continents";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'ContinentName';
        }
        
        protected function getKeyField() {
            return "ContinentCode"; 
        }
        
        public function getContinents(){
            $sql = $this->getSelectStatement() . " INNER JOIN ImageDetails ON Continents.ContinentCode = ImageDetails.ContinentCode 
                        GROUP BY Continents.ContinentCode";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
    } 
?>