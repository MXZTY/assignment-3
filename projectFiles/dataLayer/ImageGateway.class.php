<?php
    class ImageGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        protected function getSelectStatement() {    
            return "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO,
                            ContinentCode, Path
                    FROM ImageDetails";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'CountryCodeISO';
        }
        
        protected function getKeyField() {
            return "ImageID"; 
        }
        
        public function getUserImages($userId) {
            $sql = "SELECT ImageID, Title, Path
                     FROM ImageDetails
                     WHERE UserID = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $userId)); 
            return $statement->fetchAll();
        }
    } 
?>