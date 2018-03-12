<?php
    /*
        A repurposing of the Chapter 11 project 3 lab, with aray values replaced with calls to the DB. 
        This page is used to desplay all the posts in the DB. 
    */
    include_once("include/config.inc.php");
    include("general.php");
    
    try {
        $postsDB = new PostGateway($connection);
    } catch (PDOException $e){
    }
    
   function generateLink($url, $label, $class) {
       echo "<a href='$url'  class='$class'>  $label </a>";
   }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Assignment 2</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    
</head>

<body>
    <header>
        <!--Header-->
        <?php include('include/header.inc.php'); ?>
    </header>


    <!-- Page Content -->
    <main class="container">
        <div class="row">
            <!--Left Nav-->
            <?php include('include/side-panel.inc.php') ?>

            <div class="col-md-10">

                <div class="jumbotron" id="postJumbo">
                    <h1>Posts</h1>
                    <p>Read other travellers' posts ... or create your own.</p>
                    <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
                </div>        
      
                 <!-- start post summaries -->
                 <div class="postlist">

                   <?php
                        // Fetch all Post data, cycle through it and display
                        $posts = $postsDB->getAll();
                        foreach($posts as $row) { ?>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <?php 
                                        $image = '<img src="images/medium/' . $row['Path'] . '" alt="' . $row['Title'] . '" class="img-responsive"/>';
                                        $post = 'post.php?id=' . $row['PostID'];
                                        generateLink($post, $image, 'none');
                                       ?>
                                </div>  <!-- End Image -->
                                <div class='col-md-8'>
                                    <h2>  <?php echo $row['Title']; ?></h2>  
                                    <div class='details'> Posted by 
                                        <?php outputLink('single-user.php?id=' . $row['UserID'], $row['FirstName'] . ' ' . $row['LastName'], 'none'); ?>
                                        <span class='pull-right'> <?php echo $row['PostTime']; ?> </span>
                                        </div> 
                                            <p class='excerpt'> <?php echo $row['Message']; ?> </p> 
                                            <p class='pull-right'> <?php outputLink($post, 'Read more', 'btn btn-primary btn-sm'); ?> </p> 
                                </div> <!-- End Content Pane -->
                            </div>   <!-- /.row --> <hr>
                      <?php  }?>
                                          
                 </div>   <!-- end postlist -->         
                            
            </div>  <!-- end col-md-10 -->
        </div>   <!-- end row -->
    </main>
    

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>