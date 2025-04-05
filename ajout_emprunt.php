<?php 
    include 'timeout.php';

    if(!isset($_SESSION['full_name'])) { 
        header('Location: login.php');
        exit();
    } 

    include 'db_connect.php';

    $books = $bdd->query("SELECT id, titre FROM livres WHERE disponibilite > 0")->fetchAll();
    $error = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      extract($_POST);
      $query = $bdd->prepare("SELECT id FROM adhérents WHERE id = ?");
      $query->execute([$id]);
      $member = $query->fetch();
  
      if ($member) {
        $memberId = $member['id'];
        $insertLoan = $bdd->prepare("INSERT INTO emprunts (membre_id, livre_id, date_emprunt, date_retour, statut) VALUES (?, ?, ?, ?, 'En cours')");
        $insertLoan->execute([$memberId, $bookId, $loanDate, $returnDate]);
        if($insertLoan) {
          $updateBook = $bdd->prepare("UPDATE livres SET disponibilite = disponibilite - 1 WHERE id = ?");
          $updateBook->execute([$bookId]);
          if($updateBook) {
            $_SESSION['add-success'] = 1;
            header('Location: liste_emprunts.php');
            exit();
          }
        }
      }

        
    }
    $page_title = "Ajout Emprunt";
    $template = "ajout_emprunt";
    include 'layout.phtml';
  
  ?>