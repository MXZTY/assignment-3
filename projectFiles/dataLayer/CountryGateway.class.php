<?php
    /*An exstenion of the AbstractGateway specified for the Countries table*/
    class CountryGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT ISO, CountryName,  Capital, Countries.CityCode, Area, 
                        Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName,
                        PhoneCountryCode, Languages, Neighbours, CountryDescription
                    FROM Countries";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'CountryName';
        }
        
        protected function getKeyField() {
            return "ISO"; 
        }
        
        public function getCountries(){
            $sql = $this->getSelectStatement() . " INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO 
                GROUP by Countries.CountryName";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
    } 
?>