<?php 
    session_start();
    include("dataLayer/FavoriteList.class.php");
    
    /*Check if the temporary cookie from the post/image page was set otherwise redirect to error*/
    if(!isset($_COOKIE['temp'])){
        header("Location: error.php");
    }

    /*Initialize the SESSION variable*/
    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    $newFav = unserialize($_COOKIE['temp']);
    
    /*Add the data in the temporary cookie to the FavoriteList used by the session to hold more data than a cookie,
        I'll admit this is a little hacky, but it's betterish than the invisble form I used before*/
    if($_GET['type'] == 'post') {
        $posts = $newFav->getPost();
        foreach($posts as $key => $value) {
            $favorites->addFavPost($key, $value[0], $value[1]);
        }
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-post.php?added=true&id=". $_GET['id']);
    } else {
        $images = $newFav->getImage();
        foreach($images as $key => $value) {
            $favorites->addFavImage($key, $value[0], $value[1]);
        }
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-image.php?added=true&id=" . $_GET['id']);
    }

?>