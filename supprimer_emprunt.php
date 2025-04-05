<?php
    include 'timeout.php';
    include 'db_connect.php';

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $query = $bdd->prepare('DELETE FROM emprunts WHERE id = ?');
        $query->execute([$id]);
        $_SESSION['delete-success'] = 1;
    } else {
        $_SESSION['delete-success'] = 0;
    }

    header('Location: liste_emprunts.php');
    exit();
?>