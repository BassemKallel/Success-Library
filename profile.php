<?php
    include 'timeout.php';

    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    } 
    include "db_connect.php";
    $req=$bdd->prepare('SELECT * FROM adhérents WHERE id = ? AND Role = "Admin"');
    $req->execute([$_SESSION['id']]);
    $utils=$req->fetch();

    $page_title="Profile";
    $template="profile";
    include "layout.phtml";
?>