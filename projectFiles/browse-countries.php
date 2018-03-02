<?php
    include_once("config.php");
    include 'general.php';
    
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "SELECT CountryName, ISO 
                FROM Countries 
                INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO 
                GROUP by Countries.CountryName";
                
        $statement = executePDO($pdo, $sql);
    }
    catch(PDOException $e) {}
    

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 1</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <div class="panel panel-info">
                <div class="panel-heading">Countries with Images</div>
                <div class="panel-body">
                    <?php while($row = $statement->fetch()){
                        outputLink('single-country.php?country=' . $row['ISO'], $row['CountryName']);
                    }?>
                </div>

            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>