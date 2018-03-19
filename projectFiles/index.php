<?php?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.css" /> 
        <link rel="stylesheet" href="css/assignment-css.css" />
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container-fluid" style='max-width:70%;'>
            <h3 class='panel panel-heading center center-text inverse-color'></br> Explore These Options </br> </h3>
            <div class='col-md-12'>
                </br>
                <!--Countries  Card -->
                <div class="card col-md-4">
                    <a href="browse-countries.php">
                        <img class='img-circle img-responsive' src="images/misc/home_countries.jpg" alt="countries"/>
                    </a>
                    <div class='center-text'>
                        </br>
                        <a href='browse-countries.php'><button class='btn-lg btn-warning inverse-color'>Countries</button></a>
                    </div>

                </div>
                
                <!--Images  Card -->
                <div class="card col-md-4">
                    <a href="browse-images.php">
                        <img class='img-circle img-responsive' src="images/misc/home_images.jpg" alt="images"/>
                    </a>
                    <div class='center-text'>
                        </br>
                        <a href='browse-images.php'><button class='btn-lg btn-warning inverse-color'>Images</button></a>
                    </div>
                </div>
                
                <!--Users  Card -->
                <div class="card col-md-4">
                    <a href="browse-users.php">
                        <img class='img-circle img-responsive' src="images/misc/home_users.jpg" alt="users"/>
                    </a>
                    <div class='center-text'>
                        <br>
                        <a href='browse-users.php'><button class='btn-lg btn-warning inverse-color'>Users</button></a>
                    </div>
                </div>
            </div>
        </main>
        
        </br></br>
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>