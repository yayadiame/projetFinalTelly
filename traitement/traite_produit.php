<?php
session_start();
include "../config.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nom = $_POST['nom'];
    $seuil = $_POST['seuil'];
    $quantite = $_POST['quantite'];
    $prix_vente = $_POST['prix_vente'];
    $categorie = $_POST['categorie'];
    $file= $_FILES['file'];

    if(empty($nom) || empty($seuil) || empty($quantite) || empty($prix_vente) || empty($categorie) || !isset($_FILES['file']) || $_FILES['file']['error'] !== 0){
        $_SESSION['errore'] = "Tous les champs sont obligatoires";
        header('Location: ../pages/produit.php');
        exit();
    }

    // $profil = null;
    if(isset($_FILES['file']) && $_FILES['file']['error'] === 0){
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $photo = "avatar".time().".".$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], "../dossier_images/".$photo);
        $profil = $photo;
    }

    $sql = "INSERT INTO produit (profil, seuil, quantite, prix_vente, nom, id_categorie)
            VALUES(:profil, :seuil, :quantite, :prix_vente, :nom, :id_categorie)";

    $query = $db->prepare($sql);
    $query->execute([
        ":profil" => $profil,
        ":seuil" => $seuil,
        ":quantite" => $quantite,
        ":prix_vente" => $prix_vente,
        ":nom" => $nom,
        ":id_categorie" => $categorie
    ]); 


    header('Location:../pages/produit.php');
    exit();
}