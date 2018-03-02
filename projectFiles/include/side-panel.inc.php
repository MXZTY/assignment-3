<?php 
    $continentSQL = "SELECT Continents.ContinentCode, ContinentName
                         FROM Continents INNER JOIN ImageDetails ON Continents.ContinentCode = ImageDetails.ContinentCode
                         GROUP BY Continents.ContinentCode";
    $continentStmnt = executePDO($pdo, $continentSQL);
        
    $countrySQL = "SELECT ISO, CountryName
                   FROM Countries INNER JOIN ImageDetails ON ISO = CountryCodeISO
                   GROUP BY ISO";
    $countryStmnt = executePDO($pdo, $countrySQL);
    
    function outputPanel($label, $value, $page) {
        echo "<a href='browse-images.php?$page=$value'>$label</a>";
    }
    
?>

<aside class="col-md-2">
    <div class="panel panel-info">
        <div class="panel-heading">Continents</div>
        <ul class="list-group">
            <?php while($row = $continentStmnt->fetch()){ ?>
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
            <?php while($row = $countryStmnt->fetch()){ ?>
            <li class="list-group-item">
                <?php outputPanel($row['CountryName'], $row['ISO'], "country"); ?>
            </li>
            <?php }?>
        </ul>
    </div>
    <!-- end continents panel -->
</aside>