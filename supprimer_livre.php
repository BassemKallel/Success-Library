<?php

    include 'timeout.php';
    include 'db_connect.php';
    $query = $bdd->prepare('DELETE FROM livres WHERE id =?');
    $query->execute([$_GET['id']]);
    if($query){
        $_SESSION['delete-success'] = 1;
        header('Location: liste_livres.php');
    exit();
}  
?>