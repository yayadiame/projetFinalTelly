<?php
session_start();
include "../config.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
     $mot_de_passe=$_POST["mot_de_passe"];

    if(empty($email) || empty($mot_de_passe)){
        $_SESSION["error"]="veuillez remplir les champs";
        header('Location: ../pages/connexion.php');
        exit();
    } 

    $sql="SELECT * FROM users ";
    $requete=$db->prepare($sql);
    $requete->execute();
    $users=$requete->fetchAll(PDO::FETCH_ASSOC);

    // if($users && $users['mot_de_passe']==$mot_de_passe && $users["role"]=="admin"){
    //         $_SESSION['user']=$user;
    //         header("location:../pages/accueil.php");
    //         exit();
    //     }elseif ($users && $users['mot_de_passe']==$mot_de_passe && $users["role"]=="vendeur") {
    //         $_SESSION['user']=$user;
    //          header("location:../pages/vendeur.php");
    //         exit();
    //     }else {
    //         $_SESSION['error']="email ou password incorrecte !!";
        // }
    $faunt=false;
    foreach($users as $user){
        if($email===$user["email"] && password_verify($mot_de_passe, $user['mot_de_passe'])){
            $_SESSION['user']=[
                "id" => $user['id'],
                "nom" => $user['nom'],
                "prenom" => $user['prenom'],
                "address" => $user['address'],
                "mot_de_passe" => $user['mot_de_passe'],
                "profil" => $user['profil'],
                "email" => $user['email'],
                "role" => $user['role']
            ];
            
            $faunt=true;
            break;
        }
    };
    if($faunt){
         $_SESSION["success"] = "Connexion réussie";
        if($user["role"]==="admin"){
            header("Location:../pages/accueil.php");
            exit();
        }
        elseif($user["role"]==="vendeur"){
            header("Location:../pages/accueil_vendeur.php");
            exit();
        }
    }

    $_SESSION["error"]="email ou mot de passe incorrect";
    header('Location:../pages/connexion.php');
    exit();
}




























































//     if($email==)
// $sql="INSERT INTO users (email, mot_de_passe)
// VALUES(:email, :mot_de_passe)";
// $query=$db->prepare($sql);
// $query->execute([
//     ":email" => $email,
//     ":mot_de_passe" => $mot_de_passe
// ]);
// header('location:dasbord_admin.php');
// exit();