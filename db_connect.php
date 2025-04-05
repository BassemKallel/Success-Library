<?php
    define("db_host","localhost");
    define("username","root");
    define("password","");
    define("db_name","crud_project");
    try{
        $bdd=new PDO('mysql:local='.db_host.';dbname='.db_name,username,password);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die('Erreur :'.$e->getMessage());
    }
    
?>