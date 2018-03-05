<?php
    class CountryGateway extends TableDataGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT ISO, CountryName,  Capital, CityCode, Area, 
                        Population, Continent, TopLevelDomain, CurrencyCode, 
                        PhoneCountryCode, Languages, Neighbours, CountryDescription
                    FROM Countries";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'CountryName';
        }
        
        protected function getPrimaryKeyName() {
            return "ISO"; 
        }
    } 
?>