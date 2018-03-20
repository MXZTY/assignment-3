<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: error.php");
    }
    
    $id = $_GET['id'];
    try{
        $imageDB = new ImageGateway($connection);
        $image = $imageDB->getFullImageDetail($id);
    }
    catch (PDOException $e) {}
    
    /*create a temporary cookie to be used if the user clicks on the favorite button to transfer info to the session page*/
    $favorites = new FavoriteList();
    $favorites->addFavImage($id, $image['Path'], $image['Title']);
    setcookie('temp', serialize($favorites), 0, "/", 'comp3512-assignment2-aarnd649.c9users.io');
    
    if(isset($_GET['added']) || !empty($_GET['added'])){
        saveFavorite('image', $id, $image['Path'], $image['Title']);
        outputFavoritesJavaScript();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Assignment 2</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/assignment-css.css" />
    
   <!--Script for the dynamic google map-->
   <script type="text/javascript"> var directions = {lat: <?php echo $image['Latitude']; ?>, lng: <?php echo $image['Longitude']; ?>};</script>
                            <script type='text/javascript' language="javascript" src='js/map.js'></script>

</head>

<body>
    <?php include 'include/header.inc.php'; ?>


    <!-- Page Content -->
    <main class="container">
        <div class="row">
            
            <?php include 'include/side-panel.inc.php'; ?>
            
            <div class="col-md-10">
                <div class="row">
            
                    
                    <div class="col-md-8">                                                
                        <img class="img-responsive" src="images/medium/<?php echo $image['Path'];?>">
                        <p class="description"> <?php echo $image['Description'];?></p>
                    </div>

                    <div class="col-md-4">                                                
                        

                        
                        <div class="panel panel-default">
                        <div class='panel-heading head'><?php echo $image['Title'];?></div>    
                            <div class="panel-body inverse-color">
                                <ul class="details-list noListStyle">
                                    <li>By: <a class='gold' href="single-user.php?id=<?php echo $image['UserId'];?>"> <?php echo $image['FirstName'] ." ". $image['LastName'];?></a></li>
                                    <li>Country: <a class='gold' href="single-country.php?country=<?php echo $image['ISO'];?>"><?php echo $image['CountryName'];?></a></li>
                                    <li>City: <?php echo $image['AsciiName'];?></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div id='map'></div> <!--This div will become the google map-->
                       
                        
                        <!-- Glyph Buttons -->
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href='single-image.php?added=true&id=<?php echo $id;?>'><button type='button' class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button></a>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
                            </div>
                        </div><!-- end Glyph button-->
                        
                        <!--This div will become the notification for the item being added to favorites-->
                        <div id="added-notice" class="invisible"></div>

                    </div>  <!-- end right-info column -->
                </div>  <!-- end row -->
                

            </div>  <!-- end main content area -->
        </div>
    </main>
    
    <?php include("include/footer.inc.php")?>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getDynamicAPI();?>&callback=initMap"
                async defer></script>
</body>

</html>