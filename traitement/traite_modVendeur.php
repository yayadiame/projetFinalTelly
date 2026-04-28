<?php
session_start();
include "../config.php";

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
if(!empty($mot_de_passe)){
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
}
$sql = "UPDATE users  SET nom =:nom, prenom =:prenom, email =:email, mot_de_passe =:mot_de_passe WHERE id=:id";
$preparer = $db->prepare($sql);
$preparer->execute([
    ':id' => $id,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':mot_de_passe' =>password_hash($mot_de_passe, PASSWORD_DEFAULT)
]);
    $_SESSION['message']="modifié avec succés !!";
header("Location: ../pages/vendeur.php");
exit();