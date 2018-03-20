<?php
    /*Return API key's for Google maps*/
    function getStaticAPI(){
        return "AIzaSyAfPMkcPoBqKbT4e-rcSXAYsEJZq8Z5F5w";
    }
    
    function getDynamicAPI(){
        return "AIzaSyAtxbdPwx0ImeGZJhj_01zVop1EziDV4_w";
    }
    
    function getStaticMap($country, $size) {
        $zoom = 4;
        //Format the string for the url, might move this to it's own function if further utility is neeeded
        $country = str_replace(' ', '+', $country);
        //Zoom out for bigger and smaller countries
        if ($size > 1000000) {
            $zoom = 3;
        } else if ($size < 100000) {
            $zoom = 7;
        }
           
        return "<img class='img-rounded' src=https://maps.googleapis.com/maps/api/staticmap?center=$country&zoom=$zoom&size=300x300&key=".getStaticAPI() ." >";
    }
    
    /*-----------Ouputing Functions Echo out a disired bit of HTML --------------*/
    function outputLink($link, $title, $class) {
        echo "<a href='$link' class='$class gold'>$title</a>";
    }
    
    function outputList($optValue, $optName) {
        echo "<option value='$optValue'> $optName </option>";
    }
    
    function outputSmallImage($path, $alt, $id) {
        echo generateLink("single-image.php?id=$id", generateImage("square-small", $path, $alt, 'single-image') , "col-md-4 list-group ");
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
    
    /*-----------JavaScript Generator--------------*/
    function outputFavoritesJavaScript(){
        echo '<script type="text/javascript" language="javascript" src="js/added.js"></script>';
    }
    
    /*---------------Favorites Functions------------------*/
    
    function getSessionFavorite(){
        if(!isset($_SESSION['favorite'])) {
            $_SESSION['favorite'] = serialize(new FavoriteList());
        }
        return unserialize($_SESSION['favorite']);
    }
    

    function saveFavorite($post, $id, $path, $title){
        $favorites = getSessionFavorite();
        if ($post == 'post') {
            $favorites->addFavPost($id, $path, $title);
        } else {
            $favorites->addFavImage($id, $path, $title);
        }
        
        $_SESSION['favorite'] = serialize($favorites);
    }
?>