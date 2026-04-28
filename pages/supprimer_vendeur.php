<?php
session_start();
include "../config.php";
$id=$_GET["id"];
$sup="DELETE FROM users WHERE id=:id";
$preparer=$db->prepare($sup);
$preparer->execute([":id"=>$id]);
header("location:vendeur.php");
exit();