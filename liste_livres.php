<?php
include 'timeout.php';
if(!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    }
    include "db_connect.php";
    $sql = "SELECT * FROM livres";
    $query = $bdd->prepare($sql);
    $query->execute();
    $lvrs = $query->fetchAll();
    
    $page_title = "Liste des livres";
    $template="liste_livres";
    include "layout.phtml";
?>