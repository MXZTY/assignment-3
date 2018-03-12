<?php
/*
    This is the design pattern to allow the abstraction of the other classes.
    Addapted from the lab17 and from the traditional aproach.
*/
    abstract class AbstractGateway {
           // contains connection
           protected $connection;
           
           /*
           Constructor is passed a database adapter (example of dependency injection)
           */
            public function __construct($connect) {
                if (is_null($connect)) {
                    throw new Exception("Connection is null");
                }
                $this->connection = $connect;
            }
        
        
        
        /* **ABSTRACT METHODS** */
            //Get the select statement of the class
            abstract protected function getSelectStatement();
            //Get the key paramenter for single field search
            abstract protected function getKeyField();
            //Get the order to search for specific searches
            abstract protected function getOrderFields();
    
        public function getAll() {
            $sql = $this->getSelectStatement();
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll();
        }
        
        /*
            Returns all the records in the table sorted by the specified sort order
        */
        public function findAllSorted($ascending) { 
            $sql = $this->getSelectStatement() . ' ORDER BY ' . $this->getOrderFields();
            if (! $ascending) { 
                $sql .= " DESC";  
            }            
            $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
            return $statement->fetchAll(); 
        }  
    
        public function getByKey($key) {
            $sql = $this->getSelectStatement(). ' WHERE ' . $this->getKeyField() . ' =:id';
            $statement = DatabaseHelper::runQuery($this->connection, $sql, 
                    Array(':id' => $key)); 
            return $statement->fetch();
        }
    }
?>