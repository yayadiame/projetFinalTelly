<?php
session_start();
    include "../config.php";
$id=$_POST['id'];
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$tel= $_POST['tel'];
$sql="UPDATE produit SET nom=:nom, quantite=:quantite, telprix_vente=:telprix_vente, seuil=:seuil WHERE id=:id";
$preparer=$db->prepare($sql);
$preparer->execute([
    ':id'=>$id,
    ':nom'=>$nom,
    ':quantite'=>$quantite,
    ':prix_vente'=>$prix_vente
]);
header('location:../pages/client.php');
exit();