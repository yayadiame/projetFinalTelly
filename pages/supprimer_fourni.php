<?php
    session_start();
    include "../config.php";
$id=$_GET["id"];
$sup="DELETE FROM fournisseur WHERE id=:id";
$preparer=$db->prepare($sup);
$preparer->execute([":id"=>$id]);
header("location:fournisseur.php");
exit();