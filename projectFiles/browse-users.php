<?php
    include_once("include/config.inc.php");
    include 'general.php';
    try {
        $userDB = new UserGateway($connection);
    }
    catch(PDOException $e) {}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Courgette|Simonetta" rel="stylesheet">
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/assignment-css.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <div class="panel panel-default">
                <div class="panel-heading head">Users</div>
                <div class="panel-body inverse-color">
                    <?php 
                        //Get all user data and output links to each user
                        $users = $userDB->getAll();
                        foreach($users as $row){
                            outputLink(('single-user.php?id=' .$row['UserID']), ($row['FirstName'] .' '. $row['LastName']), "col-md-3" );
                        }
                    ?>
                </div>

            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    
</html>