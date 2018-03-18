<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");
    
    if($_GET['state'] == 'logout'){
        $_SESSION['uname'] = null;
        $_SESSION['id'] = null;
    }

    try {
        if(isset($_POST['uname']) && !empty($_POST['uname'])){
            $id = $_POST['uname'];
            $psw = $_POST['psw'];
        
            $loginDB = new UserLoginGateway($connection);
            $success = $loginDB->login($id, $psw);
            if($success == 'error'){
                header("Location: login.php?state=error");
            } else{
                $_SESSION['uname'] = $id;
                $_SESSION['id'] = $success;
                header("Location: user-profile.php?id=". $success);
            }
            
        }
        
    }
    catch(PDOException $e) { echo $e->getMessage();}
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 2</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        
        <script type="text/javascript" language="javascript" src="js/hover.js"></script>

    </head>
    
    <body>
        <main class="container-fluid jumbotron loginscreen">
             <h1>Share Your Travels!</h1>
        <div class="panel panel-default">
            <div class='login-image col-md-12'>
                </br>
                <img src='images/misc/travel.jpg' alt='Login to explore!'></br></br>
            </div>
            <h2 class='center-text'>Login:</h4>
            <form action="login.php" method="POST" id="loginForm" class="form-horizontal">
                 <div class="form-loginForm">
                    <h4 for="uname" class="center-text"><b>Username: </b></h3>
                    <input type="text" class='input-lg' placeholder="Enter Username" name="uname" required>
                    </br>
                    <h4 for="psw" class="center-text"><b>Password: </b></h3>
                    <input type="password" class='input-lg' placeholder="Enter Password" name="psw" required></br>
                    </br>
                    <?php if(isset($_GET['state']) && $_GET['state'] == 'error'){echo '<p style="color:black!important;">Error while logging in!</p>';}?>
                    <button type="submit" class="btn btn-info">Login</button>
                </div>
            </form>
        </div>
    </main>
    
    </body>
</html>