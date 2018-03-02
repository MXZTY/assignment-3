<?php
    include_once("config.php");
    include("general.php");
    
    if(!isset($_GET['country']) ||empty($_GET['country'])) {
        header("Location: error.php");
    }
    $country = $_GET['country'];
    
    try {
        
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $countrySQL = "SELECT CountryName, ISO, Capital, Area, Population, CurrencyName, CountryDescription
                FROM Countries 
                WHERE ISO = :country";
        $countryStmnt = $pdo->prepare($countrySQL);
        $countryStmnt->bindValue(':country', $country);
        $countryStmnt->execute();
        
        $imageStmnt = $pdo->prepare(getImageSQL('CountryCodeISO'));
        $imageStmnt->bindValue(':filter', $country);
        $imageStmnt->execute();

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
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <!--Country Details-->
            <section>
            <div>
                <?php $cRow = $countryStmnt->fetch();?>
                <h1><?php echo $cRow['CountryName'];?></h1>
                <p>Capital: <b><?php echo $cRow['Capital']?></b> </p>
                <p>Area: <b><?php echo $cRow['Area']?></b> Sq Km.</p>
                <p>Population: <b><?php echo $cRow['Population']?></b> </p>
                <p>Currence Name: <b><?php echo $cRow['CurrencyName']?></b> </p>
                <p><?php echo $cRow['CountryDescription']?></p>
                
            </div>
            </section>
            
            
            <!--Image panel-->
            <div class="panel panel-info">
                <div class="panel-heading">Images from <?php echo $cRow['CountryName'];?></div>
                <div class="panel-body">
                    <?php while($row = $imageStmnt->fetch()){
                        outputImage($row['Path'], $row['Title'], $row['ImageID']);
                    } ?>
                </div>
            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>