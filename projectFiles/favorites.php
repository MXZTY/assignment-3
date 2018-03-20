<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    $images = $favorites->getImage();
    $posts = $favorites->getPost();
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />


    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main >
            <div class="container">
            <h2>Favorites</h2>
              <!--Favorite Posts-->
            <div class="panel panel-default col-md-6">
                <div class="panel-heading head">Favorite Posts <a href="unfavorite.php?type=post"><span class="btn-warning glyphicon glyphicon-remove" aria-hidden="true"></span></a></div>
                <div class="panel-body inverse-color">
                    <?php foreach($posts as $key => $post){ ?>
                        <div class="col-md-4">
                            <?php outputLink("single-post.php?id=$key", generateImage("square-small", $post[0], $post[1], 'img-thumbnail'), ""); ?>
                            
                            <a href="unfavorite.php?type=post&id=<?php echo $key?>" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
            
                            <p><?php echo $post[1];?></p>
                            
                        </div>
                    <?php }?>
                    

                </div>
            </div>  <!--End of Favorite Posts-->

            
            <!--Favorite Image-->
            <div class="panel panel-default col-md-6">
                <div class="panel-heading head"> Favorite Images <a href="unfavorite.php?type=img"><span class="btn-warning glyphicon glyphicon-remove" aria-hidden="true"></span></a></div>
                <div class="panel-body inverse-color">
                    <?php foreach($images as $key => $image) { ?>
                    <div class="col-md-4">
                        <?php outputLink("single-image.php?id=$key", generateImage("square-small", $image[0], $image[1], 'img-thumbnail'), ""); ?>
                        
                        <a href="unfavorite.php?type=image&id=<?php echo $key?>" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                        <p class=""><?php echo $image[1];?></p>
                        </div>
                    <?php }?>
                </div>
            </div>  <!--End of Favorite Images-->
            
            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?>
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

</html>
