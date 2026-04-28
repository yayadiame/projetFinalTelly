<?php
session_start();
include "../config.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$tel= $_POST['tel'];
$file= $_FILES['file'];

    if(empty($nom) || empty($prenom) || empty($tel) || $_FILES['file']["error"] !==0){
        $_SESSION["error"]="veuillez remplir les champs";
        header('Location: ../pages/client.php');
        exit();
    } 

    $verifier="SELECT * FROM client WHERE tel=?";
    $preparer=$db->prepare($verifier);
    $preparer->execute([$tel]);
    if($preparer->fetch()){
        $_SESSION["error"]="ce numero existe deja !";
        header('Location: ../pages/client.php');
        exit();
    }

    $extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $photo="avatar".time().".".$extension;
    move_uploaded_file($_FILES['file']['tmp_name'],"../dossier_images/".$photo);
     $profil = $photo;

$sql="INSERT INTO client (profil, nom, prenom, tel)
VALUES(:profil, :nom, :prenom, :tel)";

$query=$db->prepare($sql);
$query->execute([
    ":profil" => $profil,
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":tel" => $tel
]);
    header('Location: ../pages/client.php');
    exit();
}