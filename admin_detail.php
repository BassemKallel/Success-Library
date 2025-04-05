<?php
    include 'timeout.php';
    
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    } 
    include "db_connect.php";
    $req=$bdd->prepare('SELECT * FROM adhérents WHERE id = ?');
    $req->execute([$_GET['id']]);
    $utils=$req->fetch();
    
    
    $page_title="Admin Details";
    $template="admin_detail";
    include "layout.phtml";
?>