<?php 
    
    include 'timeout.php';
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    }
    include 'db_connect.php'; 
    if (isset($_GET['id'])) {
        $bookId = intval($_GET['id']); 
        $sql = "SELECT * FROM livres WHERE id = ?";
        $query = $bdd->prepare($sql);
        $query->execute([$bookId]);
        $lvr = $query->fetch();

        if (!$lvr) {
            echo "<div class='alert alert-danger'>Book not found.</div>";
            exit();
        }

        $isAvailable = $lvr['disponibilite'] > 0;
    } else {
        echo "<div class='alert alert-danger'>No book ID provided.</div>";
        exit();
    }
    $page_title = "Détail Livre";
    $template = 'detail_livre';
    include 'layout.phtml';




?>