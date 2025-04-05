<?php

    include 'timeout.php';

    if(!isset($_SESSION['full_name'])) { 
        header('Location: login.php');
        exit();
    }

    include 'db_connect.php';


    if (isset($_GET['id'])) {
        $loanId = $_GET['id'];

        $sql = "UPDATE emprunts SET statut = 'Terminé' WHERE id = ?";
        $query = $bdd->prepare($sql);

        if ($query->execute([$loanId])) {
        
            $sql = "SELECT livre_id FROM emprunts WHERE id = ?";
            $query = $bdd->prepare($sql);
            $query->execute([$loanId]);
            $loan = $query->fetch();

            if ($loan) {
                $bookId = $loan['livre_id'];

                $sql = "UPDATE livres SET disponibilite = disponibilite  + 1 WHERE id = ?";
                $query = $bdd->prepare($sql);
                $query->execute([$bookId]);
            }
        $_SESSION['return-success'] = 1;
        header('Location: liste_emprunts.php?res=return');
        } 
        else{
            header('Location: liste_emprunts.php?error=return');
        }
    }
    else{
        header('Location: liste_emprunts.php');
    }