<?php
session_start();

include "../config.php";

$sql = "SELECT * FROM categorie";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);

// le produit 

$sql = "SELECT * FROM produit";
$query = $db->query($sql);
$produits = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../dossier_css/nav.css">
   <!-- <link rel="stylesheet" href="../dossier_css/header.css"> -->
   <link rel="stylesheet" href="../dossier_css/footer.css">
   <link rel="stylesheet" href="../dossier_css/dasbord.css">
   <link rel="stylesheet" href="../dossier_css/produit.css">
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
<section class="card-produit">
        <div class="dashboard-header dasbord" >
        <div class="search-box">
            <input type="search" class="texte" placeholder="Filtrer par nom...">
        </div>
        <?php if($_SESSION['user']['role'] === 'admin'): ?>
            <div class="actions">
                <button class="btn addCategorie"> <i class="fa-solid fa-plus"></i> Catégorie</button>
                <button class="btn addProduit"><i class="fa-solid fa-plus"></i> Produit </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="formecetegorie">
        <form action="../traitement/traite_catego.php" method="post" class="content">
                <strong class="strong">X</strong> <br> <br>
         <h2>Ajouter Catégorie</h2>
            <input type="text" name="nom" placeholder="le nom du categorie">
            <button type="submit" class="categorie2">Add categorie</button> 
        </form>
    </div>
    <div class="formeProduit">
        <form action="../traitement/traite_produit.php" method="POST" enctype="multipart/form-data">
            <?php if(isset($_SESSION['errore'])){
                // echo $_SESSION['errore'];
                // session_destroy($_SESSION['errore']);
            } ?>
            <h2>Formulaire Produit</h2>
            <input type="file" name="file" placeholder="entrez ...."> <br>
            <select name="categorie" class="categorie">
                <?php foreach($users as $user): ?>
                 <option value="<?= $user['id']?>"><?= $user['nom']?></option>
                 <?php endforeach; ?>
             </select><br>
            <input type="text" name="nom" placeholder="entrez le nom"> <br>
            <input type="number" name="quantite" placeholder="entrez la quantite"> <br>
            <input type="number" name="prix_vente" placeholder="entrez le prix de vente"> <br>
            <input type="number" name="seuil" placeholder="entrez stock"> <br>
            <button type="submit" class="btnAnnuler">Annuler</button>
            <button type="submit" class="produit">Add Produit</button>
        </form>
    </div>
   <div class="cards">
        <?php foreach($produits as $produit): ?> 
            <div class="card">
                <img src="../dossier_images/<?= $produit['profil']?>" class="avatar">
                <h4><?= $produit['nom']?></h4>
                <p>Quantité : <?= $produit['quantite']?></p>
                <p>Prix : <?= $produit['prix_vente']?> FCFA</p>
                <p>Stock : <?= $produit['seuil']?></p>
                <?php if($_SESSION['user']['role'] === 'admin'): ?>
                <div class="actions">
                    <a href="../pages/mod_produit.php?id=<?=$produit["id"]?>" class="btn-mod">Modifier</a>
                    <a href="../pages/supprimer_produit.php?id=<?=$produit["id"]?>" class="btn-annuler"  onclick = "return confirm('voulez vous vraiment supprimer ce produit ?')">supprimer</a>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
   </div>
</section>
</body>
<script src="../dossier_js/script.js"></script>
<script src="../dossier_js/fournisseur.js"></script>
<script src="../dossier_js/catego.js"></script>
</html>