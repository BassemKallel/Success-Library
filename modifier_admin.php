<?php
    include 'timeout.php';
    if (!isset($_SESSION['full_name'])) {
        header('Location: login.php');
        exit();
    } 
    include "db_connect.php";
    $reponse = $bdd->prepare('SELECT * FROM adhérents WHERE id = ?');
    $reponse->execute([$_GET['id']]);
    $donnees = $reponse->fetch();
    if (!empty($_POST)) {
        extract($_POST);
        $full_name = $nom . ' ' . $prenom;
        if ($_POST["cle"] == "1234") {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $req = $bdd->prepare('UPDATE adhérents SET full_name = ?, email = ?, password = ?, telephone = ?, Role = ?, date_naissance = ?,date_modification=? WHERE id = ?');
            $req->execute([
                $full_name,
                $email,
                $hashed_password,
                $telephone,
                $role,
                $date_naissance,
                date('Y-m-d H:i:s'),
                $_GET['id']
            ]);
            $_SESSION['full_name']=$full_name;
            
            
            header("Location: index.php");
            exit();
            
        }
    }
    $page_title = "Modifier Admin";
    $template = "modifier_admin";
    include "layout.phtml";
?>
