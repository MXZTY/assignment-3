<?php
    include_once("config.php");
    include("general.php");
    
    if(!isset($_GET['id']) && empty($_GET['id'])) {
        header("Location: error.php");
    }
    $id = $_GET['id'];
    
    try {
        
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $idSQL = "SELECT FirstName, LastName, Address, City, Country, Postal, Phone, Email
                FROM Users
                WHERE UserID = :id";
        $idStmnt = $pdo->prepare($idSQL);
        $idStmnt->bindValue(':id', $id);
        $idStmnt->execute();
    
        
        $imageStmnt = $pdo->prepare(getImageSQL('UserID'));
        $imageStmnt->bindValue(':filter', $id);
        $imageStmnt->execute();

    }
    catch(PDOException $e) {}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Assigment 1</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="css/assignment-css.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-theme.css" />  
    </head>
    
    <body>
        <?php include 'include/header.inc.php'; ?>
        
        <main class="container">
            <!--Country Details-->
            <section>
                <div>
                    <?php $cRow = $idStmnt->fetch();?>
                    <h1><?php echo $cRow['FirstName']; echo " ".$cRow['LastName'];?></h1>
                    <p><?php echo $cRow['Address']?> </p>
                    <p><?php echo $cRow['City'] .", " .$cRow['Postal'] .", " . $cRow['Country'];?></p>
                    <p><?php echo $cRow['Phone']?> </p>
                    <p><?php echo $cRow['Email']?></p>
                </div>
            </section>
            
            
            <!--Image panel-->
            <div class="panel panel-info">
                <div class="panel-heading">Images from <?php echo $cRow['CountryName'];?></div>
                <div class="panel-body">
                    <?php while($row = $imageStmnt->fetch()){
                        outputImage($row['Path'], $row['Title'], $row['ImageID']);
                    } $pdo = null //close connection?>
                </div>
            </div>
        </main>
        
        
        
        <?php include 'include/footer.inc.php'; ?> 
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
    

        

</html>