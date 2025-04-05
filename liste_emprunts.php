<?php 

    include 'timeout.php';
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    }
    include 'db_connect.php';
    $sql = "SELECT e.id, a.full_name AS member_name, l.titre AS book_title, e.date_emprunt, e.date_retour, e.statut
            FROM emprunts e, adhérents a, livres l
            WHERE e.membre_id = a.id AND e.livre_id = l.id";
    $query = $bdd->prepare($sql);
    $query->execute();
    $loans = $query->fetchAll();
    $page_title = 'Liste des emprunts';
    $template = 'liste_emprunts';
    include 'layout.phtml';
?>