<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: error.php");
    }

    $id = $_GET['id'];
    try {
        $postDB = new PostGateway($connection);
        $uRow = $postDB->getSinglePostData($id);
    }
    catch(PDOException $e) {}
    
    //If the favorites button has been hit save the file and display the favorites message
    if(isset($_GET['added']) || !empty($_GET['added'])){
        saveFavorite('post', $id, $uRow['Path'], $uRow['Title']);
        header("Location: favorites.php");
        
    }

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
            <?php 
                echo '<p class="col-md-7"><br/><br/>';
                    outputMediumImage($uRow['Path'], '', $uRow['ImageID']);
                echo '</p>';
            ?>
            
            <!--Post Details-->
            <section class='panel col-md-5'>
                <div>
                    <h1><?php echo $uRow['Title']; ?></h1>
                    <p>By:<strong><a class='dark-gold' href="single-user.php?id=<?php echo $uRow['UserID']?>"><?php echo ' '.$uRow['FirstName'] . " " . $uRow['LastName'];?></a></strong></p>
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a href='single-post.php?added=true&id=<?php echo $id;?>'><button type='button' class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button></a>
                    </div>
                </div>
                <!--This div will become the notification for the item being added to favorites-->
                <div id="added-notice"></div>
                    <p><?php echo $uRow['Message']?></p>
                </div>
               
            </section>
            
            <!--Image panel-->
            <div class="panel-default col-md-8 col-md-offset-2 center-text">
                <div class="panel-heading head"><h4>Images from <?php echo $uRow['Title'];?></h4></div>
                <div class="panel-body inverse-color">
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