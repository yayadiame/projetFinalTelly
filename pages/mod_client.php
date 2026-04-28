<?php
session_start();
 include "../config.php";
$id=$_GET['id'];
$sql="SELECT * FROM client WHERE  id=:id";
$preparer=$db->prepare($sql);
$preparer->execute(['id'=>$id]);
$client=$preparer->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    /* background: linear-gradient(135deg, #003366, #FFF); */
    background-color: #003366;
}

/* Overlay */
.formClient{
    background-color: rgba(0, 0, 0, 0.6);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;

    display: flex;
    justify-content: center;
    align-items: center;
}

/* Formulaire */
.formClient form{
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    width: 420px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    animation: fadeIn 0.5s ease;
}

/* Animation */
@keyframes fadeIn{
    from{
        opacity: 0;
        transform: translateY(-20px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

/* Titre */
.formClient h2{
    text-align: center;
    color: #001f3f;
    margin-bottom: 10px;
}

/* Inputs */
.formClient input{
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: 0.3s;
}

.formClient input:focus{
    border-color: #001f3f;
    outline: none;
    box-shadow: 0 0 5px rgba(0,31,63,0.3);
}

/* Boutons */
.btn-parent{
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

/* Bouton Ajouter */
.addClient{
    background-color: #001f3f;
    color: white;
    padding: 10px;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    flex: 1;
    transition: 0.3s;
}

.addClient:hover{
    background: #003366;
    transform: scale(1.05);
}

/* Bouton Annuler */
.btnAnnuler{
    background-color: #ff4d4d;
    color: white;
    padding: 10px;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    flex: 1;
    transition: 0.3s;
}

.btnAnnuler:hover{
    background-color: #cc0000;
    transform: scale(1.05);
}

/* Input file stylisé */
input[type="file"]{
    background-color: #f5f5f5;
    cursor: pointer;
}
    </style>
</head>
<body>
 <div class="formClient">
     <form action="../traitement/traite_mod_client.php" method="POST" enctype="multipart/form-data">
         <h2>Modifier Client</h2>
         <input type="hidden" name="id" value="<?= $client['id']?>">
         <input type="file" value="" name="file">
         <input type="text" value="<?= $client['nom']?>" name="nom" placeholder="entrer votre nom">
         <input type="text" value="<?= $client['prenom']?>" name="prenom" placeholder="entrer votre prenom">
         <input type="text" value="<?= $client['tel']?>" name="tel" placeholder="entrer votre number">
         <div class="btn-parent">
                 <button type="button" class="btnAnnuler" onclick="window.history.back()">Annuler</button>
                 <button type="submit" class="addClient">Add Client</button>
             </div>
     </form>
   </div>
</body>
</html>