<?php
session_start();
include "../config.php";

$id = $_GET['id'];

$sql = "SELECT * FROM produit WHERE id=:id";
$preparer = $db->prepare($sql);
$preparer->execute(['id' => $id]);
$produit = $preparer->fetch();
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

/* Overlay */
.formeProduit{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    background: rgba(0, 31, 63, 0.8);

    display: flex;
    justify-content: center;
    align-items: center;
}

/* Formulaire */
.formeProduit form{
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    width: 400px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: fadeIn 0.4s ease;
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
h2{
    text-align: center;
    color: #001f3f;
    margin-bottom: 15px;
}

/* Inputs */
input, select{
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background: #f9f9f9;
    transition: 0.3s;
}

input:focus, select:focus{
    border-color: #001f3f;
    outline: none;
    box-shadow: 0 0 5px rgba(0,31,63,0.3);
}

/* Boutons */
.produit{
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: #001f3f;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.produit:hover{
    background: #003366;
    transform: scale(1.05);
}
.flex{
    display: flex;
    gap:5px;
}
.btnAnnuler{
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: #ff4d4d;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.btnAnnuler:hover{
    background: #cc0000;
    transform: scale(1.05);
}

/* Input file */
input[type="file"]{
    background: #f1f1f1;
    cursor: pointer;
}
    </style>
</head>
<body>
<div class="formeProduit">
<form action="../traitement/traite_mod_produit.php" method="POST" enctype="multipart/form-data">
    <h2>Modifier Produit</h2>
    <input type="hidden" name="id" value="<?= $produit['id'] ?>">
    <input type="file" name="file"><br>
    <input type="text" name="nom" value="<?= $produit['nom'] ?>"><br>
    <input type="number" name="quantite" value="<?= $produit['quantite'] ?>"><br>
    <input type="number" name="prix_vente" value="<?= $produit['prix_vente'] ?>"><br>
    <input type="number" name="seuil" value="<?= $produit['seuil'] ?>"><br> <br>
    <div class="flex">
        <button type="button" class="btnAnnuler" onclick="window.history.back()"> Annuler</button>
    <button type="submit" class="produit">Modifier Produit</button>
    </div>

</form>
</div>
</body>
</html>