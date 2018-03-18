<?php 
    session_start();
    include("dataLayer/FavoriteList.class.php");
    
    if(!isset($_POST['type']) || empty($_POST['type']) || !isset($_POST['path']) || empty($_POST['path']) || !isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['title']) || empty($_POST['title'])){
        header("Location: error.php");
    }

    if(!isset($_SESSION['favorite'])) {
        $_SESSION['favorite'] = serialize(new FavoriteList());
    }
    
    $favorites = unserialize($_SESSION['favorite']);
    
    if($_POST['type'] == 'post') {
        $favorites->addFavPost($_POST['id'], $_POST['path'], $_POST['title']);
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-post.php?id=". $_POST['id']);
    } else {
        $favorites->addFavImage($_POST['id'], $_POST['path'], $_POST['title']);
        $_SESSION['favorite'] = serialize($favorites);
        header("Location: single-image.php?id=" . $_POST['id']);
    }

?>