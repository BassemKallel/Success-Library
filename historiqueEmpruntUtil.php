<?php 

    $sql="SELECT *
        FROM emprunts e ,adhérents a, livres l 
        WHERE e.membre_id=a.id and e.livre_id=l.id and membre_id= ? and a.Role='Utilisateur' 
        ORDER BY date_emprunt DESC";
    $res=$bdd->prepare($sql);
    $res->execute([$_GET['id']]);
    $historys=$res->fetchAll();
    include "historiqueEmpruntUtil.phtml";
?>