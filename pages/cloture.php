<?php
session_start();
include "../config.php";

$id = $_GET['id'];

// 1. Clôturer commande
$sql = "UPDATE commande SET etat = 'cloture' WHERE id = :id";  
$valide = $db->prepare($sql);
$valide->execute([":id" => $id]);

// 2. Récupérer les produits de la commande
$details = $db->prepare("SELECT id_produit, quantite FROM detailcommande WHERE id_commande = :id");
$details->execute([":id" => $id]);

$produits = $details->fetchAll();

foreach($produits as $prod){

    $id_produit = $prod['id_produit'];
    $qte = $prod['quantite'];

    // 3. Mettre à jour le stock
    $update = $db->prepare("UPDATE produit SET quantite = quantite - :quantite WHERE id = :id");

    $update->execute([
        ":quantite" => $qte,
        ":id" => $id_produit
    ]);
}

header('location:../pages/commande.php');
exit();