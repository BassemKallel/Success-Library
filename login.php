<?php
session_start();

if (isset($_SESSION['full_name'])) {
    header("Location: statistiques.php");
    exit();
}


include "db_connect.php";

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = $bdd->prepare("SELECT * FROM adhérents WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        header("Location: statistiques.php");
    } 
}
$page_title = "Login";
$template = "login";
include "login.phtml";
?>
