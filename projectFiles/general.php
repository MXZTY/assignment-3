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
    
    /*Return API key's for Google maps*/
    function getStaticAPI(){
        return "AIzaSyAfPMkcPoBqKbT4e-rcSXAYsEJZq8Z5F5w";
    }
    
    function getDynamicAPI(){
        return "AIzaSyAtxbdPwx0ImeGZJhj_01zVop1EziDV4_w";
    }
    
    function getStaticMap($country, $size) {
        $zoom = 5;
        //Format the string for the url, might move this to it's own function if further utility is neeeded
        $country = str_replace(' ', '+', $country);
        //Zoom out for bigger and smaller countries
        if ($size > 1000000) {
            $zoom = 3;
        } else if ($size < 100000) {
            $zoom = 7;
        }
           
        return "<img src=https://maps.googleapis.com/maps/api/staticmap?center=$country&zoom=$zoom&size=400x400&key=".getStaticAPI() .">";
    }
    
    /*-----------Ouputing Functions Echo out a disired bit of HTML --------------*/
    function outputLink($link, $title, $class) {
        echo "<a href='$link' class='$class'>$title</a>";
    }
    
    function outputList($optValue, $optName) {
        echo "<option value='$optValue'> $optName </option>";
    }
    
    function outputSmallImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("square-small", $path, $alt, 'single-image') , "col-md-6 list-group ");
    }
    
    function outputMediumImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("medium", $path, $alt, "img-responsive") , "");
    }
    
    function outputSquareMediumImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("square-medium", $path, $alt, "img-responsive") , "");
    }
    
    /*-----------Generating Functions Return a string to be displayed,  used by Outputing functions --------------*/
    function generateLink($url, $label, $class) {
       return "<a href='$url'  class='$class'>  $label </a>";
    }
    
    function generateImage($folder, $path, $alt, $class) {
        return "<img src='images/$folder/$path' alt='$alt' class='$class'/>";
    }
    
?>