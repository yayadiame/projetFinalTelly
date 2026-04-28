<?php 
session_start();
include "../config.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $id_fournisseur = $_POST['id_fournisseur'];
    $produits = $_POST['produits'];
    $quantites = $_POST['quantites'];

    if(empty($id_fournisseur) || empty($produits) || empty($quantites)){
        $_SESSION['erreur']="veuillez remplir tous champs";
        header('location:../pages/approvisionnement.php');
        exit();
    }

    $db->beginTransaction();

    $sql = "INSERT INTO approvissionnement (id_fournisseur, status) 
            VALUES (:id_fournisseur, 'en_cours')";

    $query = $db->prepare($sql);
    $query->execute([
        ":id_fournisseur" => $id_fournisseur,
    ]);

    $id_appro = $db->lastInsertId();

    for($i = 0; $i < count($produits); $i++) {

        $id_produit = (int) $produits[$i];
        $qte = (int) $quantites[$i];

        // récupérer prix
        $sqlPrix = "SELECT prix_vente FROM produit WHERE id = :id";
        $reqPrix = $db->prepare($sqlPrix);
        $reqPrix->execute([":id" => $id_produit]);

        $produitData = $reqPrix->fetch();
        $prix = (float) $produitData['prix_vente'];

        $sous_total = $prix * $qte;

        // insertion detail
        $insert = $db->prepare("INSERT INTO detailappro 
            (quantite, prix_achat, id_produit, id_appro)
            VALUES (:quantite, :prix, :id_produit, :id_appro)");

        $insert->execute([
            ":quantite" => $qte,
            ":prix" => $prix,
            ":id_produit" => $id_produit,
            ":id_appro" => $id_appro
        ]);

        // mise à jour stock
        $update_quantite = $db->prepare(
            'UPDATE produit SET quantite = quantite + :quantite WHERE id = :id_produit'
        );

        $update_quantite->execute([
            ":quantite" => $qte,
            ":id_produit" => $id_produit
        ]);
    }
    
    $db->commit();

    header('Location: ../pages/approvisionnement.php');
    exit();
}