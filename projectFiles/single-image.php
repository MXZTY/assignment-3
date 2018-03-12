<?php
    include_once("include/config.inc.php");
    include("general.php");
    
    if(!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: error.php");
    }
    $id = $_GET['id'];
    try{
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $imageSQL = "SELECT ImageID, Title, Path, Description, Users.UserId, FirstName, LastName, Countries.ISO, CountryName, AsciiName
                     FROM ImageDetails
                     Left Join Users On ImageDetails.UserID =  Users.UserID  
                     Left Join Countries On ImageDetails.CountryCodeISO =  Countries.ISO
                     Left Join Cities On ImageDetails.CityCode =  Cities.CityCode
                     WHERE ImageID = :id";
        $imageStmnt = $pdo->prepare($imageSQL);
        $imageStmnt->bindValue(':id', $id);
        $imageStmnt->execute();
        
        
    }
    catch (PDOException $e) {}
    
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
    <link rel="stylesheet" href="css/bootstrap-theme.css" />

</head>

<body>
    <?php include 'include/header.inc.php'; ?>


    <!-- Page Content -->
    <main class="container">
        <div class="row">
            
            <?php include 'include/side-panel.inc.php'; ?>
            
            <div class="col-md-10">
                <div class="row">
                   
                    <?php   $row = $imageStmnt->fetch(); ?>
                    
                    <div class="col-md-8">                                                
                        <img class="img-responsive" src="images/medium/<?php echo $row['Path'];?>">
                        <p class="description"> <?php echo $row['Description'];?></p>
                    </div>

                    <div class="col-md-4">                                                
                        <h2><?php echo $row['Title'];?></h2>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="details-list">
                                    <li>By: <a href="single-user.php?id=<?php echo $row['UserId'];?>"> <?php echo $row['FirstName'] ." ". $row['LastName'];?></a></li>
                                    <li>Country: <a href="single-country.php?country=<?php echo $row['ISO'];?>"><?php echo $row['CountryName'];?></a></li>
                                    <li>City: <?php echo $row['AsciiName']; $pdo = null;?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
                            </div>
                        </div>

                    </div>  <!-- end right-info column -->
                </div>  <!-- end row -->
                

            </div>  <!-- end main content area -->
        </div>
    </main>
    
    <?php include("include/footer.inc.php")?>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>