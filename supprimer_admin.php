<?php


    include 'timeout.php';
    include "db_connect.php";
    $reponse=$bdd->prepare('DELETE FROM adhérents where id=?');
    $reponse->execute([$_GET['id']]);
    if($_GET['id']==$_SESSION['id']){
        include 'logout.php';
    }
    header('Location: liste_admins.php');
    exit();
?>