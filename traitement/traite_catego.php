<?php
session_start();
include "../config.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nom= $_POST['nom'];
    // if(empty($categorie)){
    //       $_SESSION['errore']="ce champs et obligatoire";
    //     header('Location: ../pages/produit.php');
    //     exit();
    // }
    // $requette="SELECT * FROM categorie ";

    $sql="INSERT INTO categorie (nom)   VALUES (:nom)";

    $query=$db->prepare($sql);
    $query->execute([
        ":nom" => $nom
    ]);
    header('location:../pages/produit.php');
    exit();
}