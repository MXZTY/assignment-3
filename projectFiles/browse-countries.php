<?php
    include_once("include/config.inc.php");
    include 'general.php';
    
    try {
        $countryDB = new CountryGateway($connection);
    }
    catch(PDOException $e) {}
    

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/assignment-css.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <div class="panel panel-default">
                <div class="panel-heading head">Countries with Images</div>
                <div class="panel-body inverse-color">
                    <?php
                        //Get all countries with images, display the links to those countries
                        $countries = $countryDB->getCountries();
                        foreach($countries as $row) {
                            outputLink('single-country.php?country=' . $row['ISO'], $row['CountryName'], 'col-md-3');
                    }?>
                </div>

            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>