<?php
    function outputImage($path, $alt, $link)  {
        echo "<a href='single-image.php?id=$link'class='col-md-1 list-group'>";
        echo "<img src='images/square-small/$path' alt='$alt'/>";
        echo "</a>";
    }
    
    function getImageSQL($table){
        $imageSQL = "SELECT ImageID, Title, Path
                     FROM ImageDetails
                     WHERE $table = :filter";
        return $imageSQL;
    }
    
    function executePDO($pdo, $sql) {
        $Stmnt = $pdo->prepare($sql);
        $Stmnt->execute();
        return $Stmnt;
    }
    
    function outputLink($link, $title, $class) {
        echo "<a href='$link' class='$class'>$title</a>";
    }
    
    function outputList($optValue, $optName) {
        echo "<option value='$optValue'> $optName </option>";
    }
?>