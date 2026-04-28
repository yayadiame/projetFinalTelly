<?php
session_start();
    include "../config.php";
$id=$_GET['id'];
$sql="SELECT * FROM fournisseur WHERE  id=:id";
$preparer=$db->prepare($sql);
$preparer->execute(['id'=>$id]);
$fournis=$preparer->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
.formfourni {
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #001f3f;
    /* display: none; */
}
.formfourni .show {
    display: block;
}
.formfourni h2{
    text-align: center;
    color: #001f3f;
    
}
.formfourni form {
    background: white;
    padding: 30px 22px;
    border-radius: 15px;
    position: relative;
    width: 320px;
    height: 50%;
    box-shadow: 8px 5px 15px rgba(0, 0, 0, 0.616);
    top: 20%;
    left: 38%;
}
.formfourni input {
    width: 94%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ccc;
    background-color: #00000013;
    border-radius: 10px;
    border: none;
    border-bottom: 3px solid #001f3f;
}
.addFourni {
    padding: 12px;
    background: #001f3f;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}
.btnAnnuler{
     color: white;
     float: right;
     font-size: 20px;
     font-weight: 900;
     cursor: pointer;
     background-color: red;
     padding: 8px;
     border-radius: 10px;
}  
    </style>
</head>
<body>
    <div class="formfourni">
    <form action="../traitement/traite_mod_fourni.php" method="post">
        <strong class="btnAnnuler" onclick="window.history.back()">X</strong> <br> <br>
        <h2>Ajouter Fournisseur</h2>
        <input type="hidden" value="<?= $fournis['id']?>" name="id" >
        <input type="text"   value="<?= $fournis['nom']?>" name="nom" placeholder="ex: diall0"> <br>
        <input type="text"   value="<?= $fournis['prenom']?>" name="prenom" placeholder="ex: yaya.."> <br>
        <input type="number" value="<?= $fournis['tel']?>"  name="tel" placeholder="ex: 7662675.."> <br>
        <button class="addFourni">Modifier-fournisseur</button>
    </form> 
</div>
</body>
<script src="../dossier_js/fournisseur.js"></script>
</html>