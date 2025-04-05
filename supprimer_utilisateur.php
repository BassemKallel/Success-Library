<?php
    include 'timeout.php';
    include "db_connect.php";
    $reponse=$bdd->prepare('DELETE FROM adhérents where id=?');
    $reponse->execute([$_GET['id']]);
    $_SESSION['danger'] = 1;
    header("Location: index.php"); 
    exit();
?>