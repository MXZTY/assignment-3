<?php 
    try {
        $continentDB = new ContinentGateway($connection);
        $countryDB = new CountryGateway($connection);
    } catch (PDOException $e){
    }
    
    function outputPanel($label, $value, $page) {
        echo "<a class='gold' href='browse-images.php?$page=$value'>$label</a>";
    }
    
?>

<aside class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-heading head">Continents</div>
        <div class='panel-body inverse-color'>
        <ul class='noListStyle inverse-color'>
            <?php $continents = $continentDB->getContinents();
                  foreach($continents as $row) { ?>
                <li class='inverse-color'>
                    <?php outputPanel($row['ContinentName'], $row['ContinentCode'], "continent"); ?>
                </li>
            <?php }?>
        </ul>
        </div>
    </div>
    <!-- end continents panel -->

    <div class="panel panel-default">
        <div class="panel-heading head">Popular</div>
        <div class='panel-body inverse-color'>
        <ul class="noListStyle inverse-color">
            <?php $countries = $countryDB->getCountries();
                  foreach($countries as $row) { ?>
            <li class="inverse-color">
                <?php outputPanel($row['CountryName'], $row['ISO'], "country"); ?>
            </li>
            <?php }?>
        </ul>
        </div>
    </div>
    <!-- end countries panel -->
</aside>