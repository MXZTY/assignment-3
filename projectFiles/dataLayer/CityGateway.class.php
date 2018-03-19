<?php
    /*An exstenion of the Abstract gateway specified for the city table*/
    class CityGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT Cities.CityCode, AsciiName
                    FROM Cities";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'AsciiName';
        }
        
        protected function getKeyField() {
            return "CityCode"; 
        }
        
        public function getCities(){
            $sql = $this->getSelectStatement() . " INNER JOIN ImageDetails ON Cities.CityCode = ImageDetails.CityCode
                        GROUP BY Cities.CityCode";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
    } 
?>