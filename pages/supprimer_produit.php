<?php
    session_start();
include "../config.php";
$id=$_GET['id'];
$sql="DELETE FROM produit WHERE id=:id";
$supp=$db-> prepare($sql);
$supp->execute([":id"=>$id]);
header('location:produit.php');
exit();
