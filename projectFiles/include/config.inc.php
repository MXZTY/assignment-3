<?php 
    // set error reporting on to help with debugging
    error_reporting(E_ALL);
    ini_set('display_errors','1');

    // define the database connection information
    define('DBNAME', 'travel');
    define('DBUSER', 'aarnd649');
    define('DBPASS', '');
    define('DBHOST', '');
    define('DBCONNSTRING','mysql:dbname=travel;charset=utf8mb4;');
    
    // auto load all classes so we don't have to explicitly include them
    spl_autoload_register(function ($class) {
        $file = 'dataLayer/' . $class . '.class.php';
        if (file_exists($file)) 
            include $file; 
    }); 
    
    // connect to the database
    $connection = DatabaseHelper::createConnectionInfo(array(DBCONNSTRING, DBUSER, DBPASS));
?>