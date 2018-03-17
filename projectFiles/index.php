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
        
        <main class="container">
            
            <div>
                <!--Countries  Card -->
                <div class="card">
                    <a href="browse-countries.php">
                        <img src="images/misc/home_countries.jpg" alt="countries"/>
                    </a>
                    <div>
                        <h3>Countries</h3>
                        <p>See all countries for which we have Images.</p>
                    </div>
                    
                    <div>
                        <a href="browse-countries.php">View Countries</a>
                    </div>
                </div>
                
                <!--Images  Card -->
                <div class="card">
                    <a href="browse-images.php">
                        <img src="images/misc/home_images.jpg" alt="countries"/>
                    </a>
                    <div>
                        <h3>Images</h3>
                        <p>See all of our travel images.</p>
                    </div>
                    <div>
                        <a href="browse-images.php">View Images</a>
                    </div>
                </div>
                
                <!--Users  Card -->
                <div class=" card">
                    <a href="browse-users.php">
                        <img src="images/misc/home_users.jpg" alt="countries"/>
                    </a>
                    <div>
                        <h3>Users</h3>
                        <p>See information about contributing users.</p>
                    </div>
                    <div>
                        <a href="browse-users.php">View Users</a>
                    </div>

                </div>
                
            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>