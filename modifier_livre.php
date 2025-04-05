<?php
    session_start();
    
    $_SESSION['last_activity'] = time();
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    }
    include 'db_connect.php';
    if (isset($_GET['id'])) {
        $bookId = $_GET['id'];
        $sql = "SELECT * FROM livres WHERE id = ?";
        $query = $bdd->prepare($sql);
        $query->execute([$bookId]);
        $book = $query->fetch();

        }
    
    
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        extract($_POST);
        $sql = "UPDATE livres SET titre = ?, auteur = ?, genre = ?, disponibilite = ?, resume = ?, date_modification=?  WHERE id = ?";
        $query = $bdd->prepare($sql);
        $query->execute([$titre, $auteur, $genre, $dispo, $resume, date('Y-m-d H:i:s'), $bookId]);
        if ($query) {
            $_SESSION['update-success'] = 1;
            header('Location: liste_livres.php');
            exit();
        }
    }
    $page_title = "Modifier Livre";
    $template="modifier_livre";
    include "layout.phtml";
?>