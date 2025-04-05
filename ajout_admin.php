<?php 

include "timeout.php"; 

if(!isset($_SESSION['full_name'])) { 
    header('Location: login.php');
    exit();
}

include "db_connect.php";

if(!empty($_POST)){
    extract($_POST);
    $full_name = $nom . ' ' . $prenom;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $req = $bdd->prepare('SELECT * FROM adhérents WHERE email = ?');
    $req->execute([$email]);
    $existe = $req->fetch();
    if($existe){
        $_SESSION['error'] = 1;
        header("Location: liste_admins.php");
        exit();
    }
    else{
        if($_POST["cle"] == "1234" && $role == "Admin"){
            $req = $bdd->prepare('INSERT INTO adhérents (full_name, nom, prenom, email, password, Role, date_naissance, telephone) VALUES (?, ?, ?,  ?, ?, ?, ?, ?)');
            $req->execute([
                $full_name,
                $nom,
                $prenom,
                $email,
                $password,
                $role,
                $dtn,
                $telephone
            ]);
            if($req){
            $_SESSION['add-success'] = 1;
            header("Location: liste_admins.php");
            exit();
            }
        }
    }
    
}

$page_title = "Ajout Admin";
$template = "ajout_admin";
include "layout.phtml"; 
?>
