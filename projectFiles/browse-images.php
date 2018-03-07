<?php
include_once("include/config.inc.php");
include("general.php");
$filter = "";
$filterTitle = "All";
try {
  $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $continentSQL = "SELECT Continents.ContinentCode, ContinentName FROM Continents INNER JOIN ImageDetails ON Continents.ContinentCode = ImageDetails.ContinentCode GROUP BY Continents.ContinentCode";
  $contResult = executePDO($pdo, $continentSQL);
  
  $countrySQL = "SELECT ISO, CountryName
                 FROM Countries
                 INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO
                 GROUP BY Countries.ISO";
  $countryResult = executePDO($pdo, $countrySQL);
  
  $citySQL = "SELECT Cities.CityCode, AsciiName
                 FROM Cities
                 INNER JOIN ImageDetails ON Cities.CityCode = ImageDetails.CityCode
                 GROUP BY Cities.CityCode";
  $cityResult = executePDO($pdo, $citySQL);
  
  $imageSQL = "SELECT ImageId, Title, Path FROM ImageDetails";

  //Check if the page is loading from a submited click that wasn't the clear button 
  if(!isset($_GET['clear'])) {
    if(!empty($_GET['continent'])) {
       $imageSQL .= " WHERE ContinentCode = :id";
      $filter = $_GET['continent'];
      $filterTitle = "Continent = $filter";
    } else if (!empty($_GET['country'])) {
      $imageSQL .= " WHERE CountryCodeISO = :id";
      $filter = $_GET['country'];
      $filterTitle = "Country = $filter";
    } else if (!empty($_GET['title'])){
       $imageSQL .= " WHERE Title LIKE :id";
      $filter = '%'. $_GET['title'] .'%';
      $filterTitle = "Continent = ". $_GET['title'];
    } else if (!empty($_GET['city'])) {
      $imageSQL .= " WHERE CityCode =:id";
      $filter = $_GET['city'];
      $filterTitle = "City = $filter";
    }
  }
  $imgResult = $pdo->prepare($imageSQL);
  $imgResult->bindValue(':id', $filter);
  $imgResult->execute();
  
  }
  catch (PDOException $e){
    }
    

  
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Assignment 1</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'include/header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="browse-images.php" method="get" class="form-horizontal">
              <div class="form-inline">
                
                <!--End Select Continent -->
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                  while($row = $contResult->fetch()){
                    outputList($row['ContinentCode'], $row['ContinentName']);
                  }
                ?>
              </select> <!--End Select Continent --> 
              
              <!--End Select Country -->
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php
                  while($countryRow = $countryResult->fetch()){
                    outputList($countryRow['ISO'], $countryRow['CountryName']);
                  }
                ?>
              </select> <!--End Select Country -->
              
              <!--Select City -->
              <select name="city" class="form-control">
                <option value="0">Select City</option>
                <?php
                  while($cityRow = $cityResult->fetch()){
                    outputList($cityRow['CityCode'], $cityRow['AsciiName']);
                  }
                ?>
              </select> <!--End Select City -->
              
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" name="submit" class="btn btn-primary">Filter</button>
              <?php if($filterTitle != "All"){echo '<button type="submit" name="clear" class="btn btn-success">Clear</button>';}?>
              </div>
            </form>

          </div> <!--End Filter -->
        </div>     
                                    

      <div class="panel panel-default">
        <div class="panel-heading">Images [<?php echo $filterTitle;?>]</div>
        <div class="panel-body">
		      <ul class="caption-style-2">
		        <?php while($imgRow = $imgResult->fetch()){ ?>
		          <li>
                <a href="single-image.php?id=<?php echo $imgRow["ImageId"];?>" class="img-responsive">
                <img src="images/square-medium/<?php echo $imgRow["Path"];?>" alt="<?php echo $imgRow["Title"];?>"></img>
                    <div class="caption">
                       <div class="blur"></div>
                         <div class="caption-text">
                              <p><?php echo $imgRow["Title"];?></p>
                          </div>
                    </div>
                </a>
			     </li>
			      <?php } //end loop
			         $pdo=null; //Close connection?>
         </ul>       
         </div> <!--End Panel Body -->
      </div> <!--End Panel -->
    </main>
    
    <?php include("include/footer.inc.php");?>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>