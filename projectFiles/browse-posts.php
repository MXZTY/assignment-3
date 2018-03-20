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
    <link rel="stylesheet" href="css/captions.css" />
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
                        $posts = $postsDB->getAllPostData();
                        foreach($posts as $row) { ?>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <?php 
                                        outputMediumImage($row['Path'], $row['Title'], $row['ImageID']);
                                       ?>
                                </div>  <!-- End Image -->
                                <div class='col-md-8'>
                                    <h2>  <?php echo $row['Title']; ?></h2>  
                                    <div class='details'> Posted by 
                                        <?php outputLink('single-user.php?id=' . $row['UserID'], $row['FirstName'] . ' ' . $row['LastName'], 'none'); ?>
                                        <span class='pull-right'> <?php echo '<strong>'.date_format(date_create($row['PostTime']), "d-M-Y"). '</strong>' ?> </span>
                                        </div> 
                                            <p> <?php echo substr($row['Message'], 0, 180) . '...'; ?> </p> 
                                            <p class='pull-right'><a href='single-post.php?id=<?php echo $row['PostID'] ?>' class='btn btn-warning'>Read more</a></p> 
                                </div> <!-- End Content Pane -->
                            </div>   <!-- /.row --> <hr>
                        <?php  } //End loop ?>
                                          
                 </div>   <!-- end postlist -->         
                            
            </div>  <!-- end col-md-10 -->
        </div>   <!-- end row -->
    </main>
    

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>