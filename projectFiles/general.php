<?php

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
    
    /*-----------Ouputing Functions Echo out a disired bit of HTML --------------*/
    function outputLink($link, $title, $class) {
        echo "<a href='$link' class='$class'>$title</a>";
    }
    
    function outputList($optValue, $optName) {
        echo "<option value='$optValue'> $optName </option>";
    }
    
    function outputSmallImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("square-small", $path, $alt, '') , "col-md-1 list-group");
    }
    
    function outputMediumImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("medium", $path, $alt, "img-responsive") , "");
    }
    
    /*-----------Generating Functions Return a string to be displayed,  used by Outputing functions --------------*/
    function generateLink($url, $label, $class) {
       return "<a href='$url'  class='$class'>  $label </a>";
    }
    
    function generateImage($folder, $path, $alt, $class) {
        return "<img src='images/$folder/$path' alt='$alt' class='$class'/>";
    }
    
?>