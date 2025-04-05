<?php
    include 'timeout.php';
    if(!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    }
    include "db_connect.php";

    $sql = $bdd->prepare("SELECT * FROM adhérents where id!=$_SESSION[id] and role!='Admin'");
    $sql->execute();
    $utils = $sql->fetchAll();
    $page_title = "Utilisateurs";
    $template = "index";  
    include "layout.phtml";
?>
