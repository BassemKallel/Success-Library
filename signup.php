<?php 
  session_start();
  $errors = [];

  //var_dump($_SESSION);
  if (isset($_SESSION['full_name'])) {
      header("Location: index.php");
      exit();
  }
  include 'db_connect.php';

  if(!empty($_POST)) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email= $_POST['email'];
      $tel = $_POST['phone'];
      $dtn = $_POST['date'];

      $password = $_POST['password'];
      $passwordRepeat = $_POST['repeat_password'];
      $errors = array();

    if(empty($nom) or empty($prenom)  or empty($email) or empty($tel) or empty($password)  or empty($passwordRepeat) or empty($dtn)) {
      array_push($errors, "Tous les champs sont nécessaires");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "L'email n'est pas valide!");
    }
    if(strlen($password) < 8) {
      array_push($errors, "Le mot de passe doit contenir au moins 8 caractères!");
    }
    if($password !== $passwordRepeat) {
      array_push($errors, "Les mots de passe ne correspondent pas!");
    }
    $sql = "SELECT * FROM adhérents WHERE email = ?";
    $query = $bdd->prepare($sql);
    $query->execute([$email]);
    $res = $query->fetch();
    if ($res) {
      array_push($errors, "Cet email est déjà enregistré!");
    }


  
    if(count($errors) == 0) {
      $full_name = $nom . " " . $prenom;
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO adhérents(nom,prenom,full_name, email,telephone, password,date_naissance) VALUES(?,?,?,?,?,?,?)";
      $query = $bdd->prepare($sql);
      $query->execute([$nom,$prenom,$full_name,$email,$tel,$hashedPassword,$dtn]);
        if($query) {
        $_SESSION['success'] = 1;
        header("Location: login.php");
      }
    } 
  }
  include 'signup.phtml';
?>