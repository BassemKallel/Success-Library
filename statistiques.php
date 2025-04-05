<?php
    include 'timeout.php';
    include 'db_connect.php';

    $stats = [
        'total_adhérents' => 0,
        'total_livres' => 0,
        'livres_empruntés' => 0
    ];

    $query = $bdd->query("SELECT COUNT(*) AS total FROM adhérents WHERE role != 'Admin'");
    $result = $query->fetch();
    $stats['total_adhérents'] = $result['total'];

    $query = $bdd->query("SELECT COUNT(*) AS total FROM livres");
    $result = $query->fetch();
    $stats['total_livres'] = $result['total'];

    $query = $bdd->query("SELECT COUNT(*) AS total FROM emprunts WHERE statut = 'en cours'");
    $result = $query->fetch();
    $stats['livres_empruntés'] = $result['total'];

    $page_title = "Statistiques";
    $template = 'statistiques';
    include 'layout.phtml';
?>

