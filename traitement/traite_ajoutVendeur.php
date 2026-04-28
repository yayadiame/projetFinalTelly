<?php
session_start();
include "../config.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$email= $_POST['email'];
$mot_de_passe= $_POST['mot_de_passe'];
$file= $_FILES['file'];

    if(empty($nom) || empty($prenom) || empty($email) || empty($mot_de_passe) || $_FILES['file']["error"] !==0){
        $_SESSION["error"]="veuillez remplir les champs";
        header('Location: ../pages/vendeur.php');
        exit();
    } 

    $verifier="SELECT * FROM users WHERE email=?";
    $preparer=$db->prepare($verifier);
    $preparer->execute([$email]);
    if($preparer->fetch()){
        $_SESSION["error"]="ce email existe deja !";
        header('Location: ../pages/vendeur.php');
        exit();
    }

   
    $extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
    $photo="avatar".time().".".$extension;
    move_uploaded_file($_FILES['file']['tmp_name'],"../dossier_images/".$photo);
     $profil = $photo;
    $role = "vendeur";

$sql="INSERT INTO users (profil, nom, prenom, email,mot_de_passe,role)
VALUES(:profil, :nom, :prenom, :email , :mot_de_passe , :role)";

$query=$db->prepare($sql);
$query->execute([
    ":profil" => $profil,
    ":nom" => $nom,
    ":prenom" => $prenom,
    ":email" => $email,
    ":mot_de_passe" => password_hash($mot_de_passe, PASSWORD_DEFAULT), 
    ":role" => $role
]);
    header('Location: ../pages/vendeur.php');
    exit();
}