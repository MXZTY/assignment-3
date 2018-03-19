<?php
    class ImageGateway extends AbstractGateway { 
        public function __construct($connect)    {
                parent::__construct($connect);
        }
        
        /*Bassic select Statment*/
        protected function getSelectStatement() {    
            return "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO,
                            ContinentCode, Path
                    FROM ImageDetails";
        }
        
        /*More detailed select statement that is used to join the image tabe to a user, countries, and city in order to eliminate multiple queries*/
        protected function getDetailedStatement() {
           return "SELECT ImageID, Title, Path, Description, ImageDetails.Latitude, 
                            ImageDetails.Longitude,Users.UserId, FirstName, LastName, Countries.ISO, CountryName, AsciiName
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
        
        /*Modification of the get field in abstract gateway which allows the page to query the 
            imageDetails page based on a key value pair in a specific row*/
        public function getSpecificImages($id, $specificRow) {
            $sql = $this->getSelectStatement() . " WHERE $specificRow = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $id)); 
            return $statement->fetchAll();
        }
        
        /*Modification of the get all function in abstract gateway. This allows the page to query the 
            imageDetails page for all the data on a specific image and other related tables*/
        public function getFullImageDetail($id) {
            $sql = $this->getDetailedStatement() . " WHERE " . $this->getKeyField() . " = :id";
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $id)); 
            return $statement->fetch();
        }
    } 
?>