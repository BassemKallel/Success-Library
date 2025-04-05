<?php 

    include 'timeout.php';
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    } 

    include 'db_connect.php';

    if(!empty($_POST)) {
        $title = $_POST['titre'];
        $author = $_POST['auteur'];
        $gender = $_POST['genre'];
        $availability = $_POST['dispo'];
        $summary = $_POST['resume'];
        $req=$bdd->prepare('SELECT * FROM livres WHERE titre = ?');
        $req->execute([$title]);
        $result = $req->fetch();
        if($result){
            $_SESSION['error'] = 1;
            header("Location: liste_livres.php");
        }
        else{
            $sql="INSERT INTO livres(titre,auteur,genre,disponibilite,resume,date_ajout) VALUES (?,?,?,?,?,?)";
            $query=$bdd->prepare($sql);
            $query->execute([$title, $author, $gender, $availability, $summary, date('Y-m-d H:i:s')]);
            
            if($query) {
                $_SESSION['add-success'] = 1;
                header('Location: liste_livres.php');
                exit();
            }
        }
    }
        $page_title = "Ajout Livre";
        $template = 'ajout_livre';
        include 'layout.phtml';

?>



