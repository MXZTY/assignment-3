<?php
/*
   Adapter class for the PDO API. This version is quite simple, in that it doesn't make
   use of an interface
   
   Note this is the exat one from lab 17 may need modification.
*/
class DatabaseHelper {
	
	// Create the connection to the database
   public static function createConnectionInfo($values=array()) {
       // pass in the connection string, username, and password as array
       $connString = $values[0];
       $user = $values[1]; 
       $password = $values[2];
       $pdo = new PDO($connString,$user,$password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $pdo;       
   }    

	// run an SQL query and return the cursor to the database
   public static function runQuery($connection, $sql, $parameters=array()) {
       //Ensure parameters are in an array
   	    if(!is_array($parameters)) {
   		    $parameters = array($parameters);
   	    }
   	
   	    $statement = null;
   	    if (count($parameters) > 0) {
   		    // Use a prepared statement if parameters
   		    /* do we need to bind parameters here? check the loop i put below there which will bind each param to the index of its position in $parameters.*/
   		    $statement = $connection->prepare($sql);
   		    $executedOk = $statement->execute($parameters);
   		    if (!$executedOk) {
   			    throw new PDOException;
   		    }
   	    } else {
   		    // Execute a normal query
   		    $statement = $connection->query($sql);
   		    if (!$statement) {
   		    	throw new PDOException;
   		    }
   	    }
   	
   	    return $statement;
    }
    
    public static function closeConnection($connection) {
        $connection = null;
    }
    
    // this is my connect and query function from asg1. i see we prepare the statement above but we arent binding any parameters to the query... 
    //     function connectAndQuery($sql, $arrayOfVarsUsed){
    //     try{
    //         if ($pdo == null){
    //             $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    //             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         }
    //         $query = $pdo->prepare($sql);
    //         $count = 1;
    //         if($arrayOfVarsUsed != null){
    //             foreach($arrayOfVarsUsed as $variable){
    //                 $query->bindParam($count, $variable);
    //                 $count++;
    //             }
    //         }
    //         $query->execute();
    //         return $query;
    //     } catch(PDOException $e) {
    //         die($e->getMessage());
    //     }
    // }
    
}

?>