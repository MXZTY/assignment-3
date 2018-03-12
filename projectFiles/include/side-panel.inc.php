<?php 
    try {
        $continentDB = new ContinentGateway($connection);
        $countryDB = new CountryGateway($connection);
    } catch (PDOException $e){
    }
    
    function outputPanel($label, $value, $page) {
        echo "<a href='browse-images.php?$page=$value'>$label</a>";
    }
    
?>

<aside class="col-md-2">
    <div class="panel panel-info">
        <div class="panel-heading">Continents</div>
        <ul class="list-group">
            <?php $continents = $continentDB->getContinents();
                  foreach($continents as $row) { ?>
                <li class="list-group-item">
                    <?php outputPanel($row['ContinentName'], $row['ContinentCode'], "continent"); ?>
                </li>
            <?php }?>
        </ul>
    </div>
    <!-- end continents panel -->

    <div class="panel panel-info">
        <div class="panel-heading">Popular</div>
        <ul class="list-group">
            <?php $countries = $countryDB->getCountries();
                  foreach($countries as $row) { ?>
            <li class="list-group-item">
                <?php outputPanel($row['CountryName'], $row['ISO'], "country"); ?>
            </li>
            <?php }?>
        </ul>
    </div>
    <!-- end countries panel -->
</aside>