<?php
session_start();

 include "../config.php";

if ($_SERVER['REQUEST_METHOD']=="POST") {
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $tel= $_POST['tel'];

    if(empty($nom)){
        $_SESSION['errore']="ce champs et obligatoire";
        header('Location: ../pages/fournisseur.php');
        exit();
    };

    $requette="SELECT * FROM fournisseur WHERE id=?";
    $sql="INSERT INTO fournisseur(nom, prenom, tel)
    VALUES (:nom, :prenom, :tel)";
    $query=$db->prepare($sql);
$query->execute([
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":tel" => $tel
]);
    header('Location:../pages/fournisseur.php');
    exit();
}
    
