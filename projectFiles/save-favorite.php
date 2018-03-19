<?php 
    session_start();
    include("dataLayer/FavoriteList.class.php");
    
    if(!isset($_COOKIE['temp'])){
        header("Location: error.php");
    }

    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    $newFav = unserialize($_COOKIE['temp']);
    
    if($_GET['type'] == 'post') {
        $posts = $newFav->getPost();
        foreach($posts as $key => $value) {
            $favorites->addFavPost($key, $value[0], $value[1]);
        }
        
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-post.php?id=". $_GET['id']);
    } else {
        $images = $newFav->getImage();
        foreach($images as $key => $value) {
            $favorites->addFavImage($key, $value[0], $value[1]);
        }
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-image.php?id=" . $_GET['id']);
    }

?>