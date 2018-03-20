<?php
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['country']) || empty($_GET['country'])) {
        header("Location: error.php");
    }
    $country = $_GET['country'];
    
    try {
        $countryDB = new CountryGateway($connection);
        $imageDB = new ImageGateway($connection);
        $images = $imageDB->getSpecificImages($country, "CountryCodeISO");
        $cRow = $countryDB->getByKey($country);
    } catch(PDOException $e) {}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script type="text/javascript" language="javascript" src="js/hover.js"></script>
    </head>
    
    <body>
        
        
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <!--Country Details-->
            <section>
            <div class="col-md-8">
                <h1><?php echo $cRow['CountryName'];?></h1>
                <div class="col-md-6">
                    <p>Capital: <b><?php echo $cRow['Capital']?></b> </p>
                    <p>Area: <b><?php echo $cRow['Area']?></b> Sq Km.</p>
                    <p>Population: <b><?php echo $cRow['Population']?></b> </p>
                    <p>Currence Name: <b><?php echo $cRow['CurrencyName']?></b> </p>
                    <p><?php echo $cRow['CountryDescription']?></p>
                </div>
                <div class="col-md-6 pad-bottom">
                    <?php echo getStaticMap($cRow['CountryName'], $cRow['Area'])?>
                </div>
            </div>
            </section>
            <!--Country Details End-->
            
            <!--Image panel-->
            <div class="panel panel-default col-md-4 side-panel center-text">
                <div class="panel-heading"><h4>Images from <?php echo $cRow['CountryName'];?></h4></div>
                <div class="panel-body">
                    <?php foreach($images as $row){
                            outputSmallImage($row['Path'], $row['Title'], $row['ImageID']);
                    } ?>
                     
                </div>
               
            </div>
            <div id="hover"></div> 
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>