<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    //$favorites->addFavImage(1, "6592902825.jpg", "Edworthy Park");
    $images = $favorites->getImage();
    $posts = $favorites->getPost();
    
    try {
        $imageDB = new ImageGateway($connection);
        $postDB = new PostGateway($connection);
    } catch(PDOException $e) {}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />

    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            
            <h2>Favorites</h2>
              <!--Favorite Posts-->
            <div class="panel panel-info col-md-6">
                 <div class="panel-heading">Favorite Posts</div>
                <div class="panel-body">
                    <?php foreach($posts as $key => $post){
                        outputLink("single-post.php?id=$key", generateImage("square-small", $post[0], $post[1], 'single-image'), "col-md-3 list-group"); ?>
                        <figcaption><?php echo $post[1];?></figcaption>
                    <?php }?>

                </div>
            </div>  <!--End of Favorite Posts-->

            
            <!--Favorite Image-->
            <div class="panel panel-info col-md-6">
                <div class="panel-heading"> Favorite Images</div>
                <div class="panel-body">
                    <?php foreach($images as $key => $image){
                        outputSmallImage($image[0], $image[1], $key);
                    }?>
                </div>
            </div>  <!--End of Favorite Images-->
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

</html>