<?php

    include 'timeout.php';
    if(!isset($_SESSION['full_name'])) { 
        header('Location: login.php');
        exit();
    } 
    include 'db_connect.php';
    $sql = $bdd->prepare("SELECT * FROM adhérents where Role='Admin' and id!=?");
    $sql->execute([$_SESSION['id']]);
    $utils = $sql->fetchAll();
    $page_title = "Liste des Admins";
    $template = "liste_admins";
    include 'layout.phtml';
?>