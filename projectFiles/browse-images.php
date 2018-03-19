<?php


    include_once("include/config.inc.php");
    include("general.php");
    
    try{
        $cityDB = new CityGateway($connection);
        $continentDB = new ContinentGateway($connection);
        $countryDB = new CountryGateway($connection);
        $imageDB = new ImageGateway($connection);
        $imageResult = $imageDB->getAll();
    if(!isset($_GET['title']) || empty($_GET['title'])){
        $_GET['title'] = '';
    }
      
    }
    
    catch (PDOException $e) {}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Assignment 2</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/assignment-css.css" />
   <script type="text/javascript" src="js/searchingFunctions.js"></script>
</head>

<body>
    <?php include 'include/header.inc.php'; ?>

    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-body inverse-color">
            <form action="browse-images.php" method="get" id="searchingForm" class="form-horizontal">
              <div class="form-inline">
              Filters:      |

                <!--End Select Continent -->
              <select name="continent" class="form-control" id='continent'>
                <option value="0">Select Continent</option>
                <?php
                  if(isset($_GET['continent']) || !empty($_GET['continent'])){
                    // function to search continent from aside panel. 
                  }
                  $continents = $continentDB->getContinents();
                  foreach($continents as $row) {
                    outputList($row['ContinentCode'], $row['ContinentName']);
                  }
                ?>
              </select> <!--End Select Continent --> 
              |
              <!--End Select Country -->
              <select name="country" class="form-control" id='country'>
                <option value="0">Select Country</option>
                <?php
                if(isset($_GET['country']) || !empty($_GET['country'])){
                    // function to search continent from aside panel. 
                  }
                  $countries = $countryDB->getCountries();
                  foreach($countries as $row) {
                    outputList($row['ISO'], $row['CountryName']);
                  }
                ?>
              </select> <!--End Select Country -->
              |
              <!--Select City -->
              <select name="city" class="form-control" id='city'>
                <option value="0">Select City</option>
                <?php
                if(isset($_GET['city']) || !empty($_GET['city'])){
                    // function to search continent from aside panel. 
                  }
                   $cities = $cityDB->getCities();
                  foreach($cities as $row) {
                    outputList($row['CityCode'], $row['AsciiName']);
                  }
                ?>
              </select> <!--End Select City -->
              |
              <input type="text" placeholder="Search title" class="form-control" name="title" id="title" value=<?php echo"'". $_GET['title']."'"?> >
                   |
              </div>
            </form>

          </div> <!--End Filter -->
        </div>     
                                    

      <div class="panel panel-default">
        <div class="panel-heading" id='query-string'>All Images</div>
        <div class="panel-body inverse-color">
		      <ul class="flex-container">
		        <?php 
		        foreach($imageResult as $imgRow){ ?>
		          <li class='filteredImages' title="<?php echo $imgRow["Title"];?>" continent="<?php echo $imgRow["ContinentCode"];?>" country="<?php echo $imgRow["CountryCodeISO"];?>" city="<?php echo $imgRow["CityCode"];?>">
                <a href="single-image.php?id=<?php echo $imgRow["ImageID"];?>" class="img-responsive">
                <img src="images/square-medium/<?php echo $imgRow["Path"];?>" alt="<?php echo $imgRow["Title"];?>"></img>
                    <div class="caption invisible">
                       <div class="hover"></div>
                         <div class="caption-text">
                              <p><?php echo $imgRow["Title"];?></p>
                          </div>
                    </div>
                </a>
			     </li>
			      <?php } //end loop?>
         </ul>       
         </div> <!--End Panel Body -->
      </div> <!--End Panel -->
    </main>
    
    <?php include("include/footer.inc.php");?>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>