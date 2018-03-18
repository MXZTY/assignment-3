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
        
        protected function getDetailedStatement() {
           return "SELECT ImageID, Title, Path, Description, ImageDetails.Latitude, ImageDetails.Longitude,Users.UserId, FirstName, LastName, Countries.ISO, CountryName, AsciiName
                     FROM ImageDetails
                     Left Join Users On ImageDetails.UserID =  Users.UserID  
                     Left Join Countries On ImageDetails.CountryCodeISO =  Countries.ISO
                     Left Join Cities On ImageDetails.CityCode =  Cities.CityCode";
        }
        
        //This may be unneeded will see
        protected function getOrderFields()    {
            return 'CountryCodeISO';
        }
        
        protected function getKeyField() {
            return "ImageID"; 
        }
        
        public function getSpecificImages($id, $specificRow) {
            $sql = $this->getSelectStatement() . " WHERE $specificRow = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $id)); 
            return $statement->fetchAll();
        }
        
        public function getFullImageDetail($id) {
            $sql = $this->getDetailedStatement() . " WHERE " . $this->getKeyField() . " = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $id)); 
            return $statement->fetch();
        }
    } 
?>