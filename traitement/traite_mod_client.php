<?php
session_start();
    include "../config.php";
$id=$_POST['id'];
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$tel= $_POST['tel'];
$sql="UPDATE client SET nom=:nom, prenom=:prenom, tel=:tel WHERE id=:id";
$preparer=$db->prepare($sql);
$preparer->execute([
    ':id'=>$id,
    ':nom'=>$nom,
    ':prenom'=>$prenom,
    ':tel'=>$tel
]);
header('location:../pages/client.php');
exit();