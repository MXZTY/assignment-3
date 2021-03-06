<?php
    session_start();
    include_once("include/config.inc.php");
    include("general.php");

    try {
        if(!isset($_SESSION['uname']) || empty($_SESSION['uname'])){
            header("Location: login.php");
        }
        if((!isset($_SESSION['id']) || empty($_SESSION['id'] ) && $_SESSION['id'] != $_GET['id'])){
            header("Location: login.php");
        }
        $id = $_SESSION['id'];
        $userDB = new UserGateway($connection);
        $imageDB = new ImageGateway($connection);
        $images = $imageDB->getSpecificImages($id, "UserID");

    }
    catch(PDOException $e) { echo $e->getMessage();}
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
            <?php $uRow = $userDB->getByKey($id);?>
            
              <!--Country Details-->
            <section class='panel panel-default profileInfo center-text col-md-12'>
                    <h1 class='center-text'><?php echo "Hello, " . $uRow['FirstName']; echo " ".$uRow['LastName'];?></h1>

                <div class='col-md-12'>
                    
                    <h3 class=center-text>your information:</h3> 
                    <h4 id='inputLabel' class='col-md-6 text-right'>Address: </h4><h4 class='col-md-6 text-left' name="Address"><?php echo $uRow['Address']?></h4>
                    <h4 id='inputLabel' class='col-md-6 text-right'>Location: </h4><h4 class='col-md-6 text-left' name="Location"><?php echo $uRow['City'] .", " .$uRow['Postal'] .", " . $uRow['Country'] ?></h4>
                    <h4 id='inputLabel' class='col-md-6 text-right'>Phone Number:  </h4><h4 class='col-md-6 text-left' name="Phone"><?php echo $uRow['Phone'] ?></h4>
                    <h4 id='inputLabel' class='col-md-6 text-right'>User Name: </h4><h4 class='col-md-6 text-left' name="UserName"><?php echo $uRow['Email']?></h4>
 
                </div>
            </section>
            
            <!--Image panel-->
            <section class="panel panel-default container center-text col-md-6 col-md-offset-3">
                <div class="panel-heading head user-panel"> Your Images: </div>
                <div class="panel-body inverse-color image-panel">

                    <?php foreach($images as $row){
                        outputMediumImage($row['Path'], $row['Title'], $row['ImageID']);
                    } ?>
                    </ul>
                </div>
            </section>
            <div id="hover"></div>
        </main>
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    
</html>