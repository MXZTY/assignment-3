<?php
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['id']) && empty($_GET['id'])) {
        header("Location: error.php");
    }

    $id = $_GET['id'];
    try {
        $postDB = new PostGateway($connection);
    }
    catch(PDOException $e) {}
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
                $uRow = $postDB->getSinglePostData($id);
            ?>
            
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

             <form method="post" action="save-favorite.php" id="form" class="invisible">
                                <input type="text" name="id" value="<?php echo $id;?>">
                                <input type="text" name="type" value="post">
                                <input type="text" name="title" value="<?php echo $uRow['Title'];?>">
                                <input type="text" name="path" value="<?php echo $uRow['Path'];?>">
                            </form>
            
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>