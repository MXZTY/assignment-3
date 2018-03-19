<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['id']) && empty($_GET['id'])) {
        header("Location: error.php");
    }

    $id = $_GET['id'];
    try {
        $postDB = new PostGateway($connection);
        $uRow = $postDB->getSinglePostData($id);
    }
    catch(PDOException $e) {}
    
    $favorites = new FavoriteList();
    $favorites->addFavPost($id, $uRow['Path'], $uRow['Title']);
    setcookie('temp', serialize($favorites), 0, "/", 'comp3512-assignment2-aarnd649.c9users.io');
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        
        <script type="text/javascript" language="javascript" src="js/hover.js"></script>
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <?php 
                echo '<p class="col-md-7"><br/><br/>';
                outputMediumImage($uRow['Path'], '', $uRow['ImageID']);
                echo '</p>';
            ?>
            
            

            
            <!--Post Details-->
            <section class='panel col-md-5'>
                <div>
                    <h1><?php echo $uRow['Title']; ?></h1>
                    <p><?php echo $uRow['FirstName'] . " " . $uRow['LastName'];?> </p>
                    <p><?php echo $uRow['Message']?></p>
                </div>
            </section>
            
            <!--Image panel-->
            <div class="panel panel-info col-md-12">
                <div class="panel-heading">Images from <?php echo $uRow['Title'];?></div>
                <div class="panel-body">
                    <?php
                        $images = $postDB->getRelatedImages($uRow['PostID']);
                        foreach($images as $image){
                            outputSmallImage($image['Path'], $image['Title'], $image['ImageID']);
                        }
                    ?>
                </div>
            </div>
            <div id="hover"></div>
            
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>