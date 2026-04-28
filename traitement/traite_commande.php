<?php
session_start();
    include "../config.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_client = $_POST['noms'];
        $produits = $_POST['produits'];
        $quantite = $_POST['quantites'];

        if(empty($id_client) || empty($produits) || empty($quantite)){
            $_SESSION['errore'] = "Ce champ est obligatoire";
            header('Location: ../pages/commande.php');
            exit();
        }

        $db->beginTransaction();
        $sql = "INSERT INTO commande (id_client, etat) 
        VALUES (:id_client, 'en_cours')";

        $query = $db->prepare($sql);
        $query->execute([
                ":id_client" => $id_client,
        ]);
        $id_commande = $db->lastInsertId();

        for($i = 0; $i < count($produits); $i++) {

    $id_produit = $produits[$i];
    $qte = $quantite[$i];

    // récupérer prix
    $sqlPrix = "SELECT prix_vente FROM produit WHERE id = :id";
    $reqPrix = $db->prepare($sqlPrix);
    $reqPrix->execute([
        ":id" => $id_produit
    ]);
    $produitData = $reqPrix->fetch();
    $prix = $produitData['prix_vente'];
    // calcul
    $sous_total = $prix * $qte;
    // insertion
    $insert = $db->prepare("INSERT INTO detailcommande (quantite, prix, sous_total, id_produit, id_commande)
        VALUES (:quantite, :prix, :sous_total, :id_produit, :id_commande)");

    $insert->execute([
        ":quantite" => $qte,
        ":prix" => $prix,
        ":sous_total" => $sous_total,
        ":id_produit" => $id_produit,
        ":id_commande" => $id_commande
    ]);
}
        $db->commit();

        header('Location: ../pages/commande.php');
        exit();
    }