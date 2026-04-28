<?php
// session_start();
// if(!isset($_SESSION['user'])){
//     header('location:connexion.php');
//   exit();
// }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../dossier_css/nav.css">
   <link rel="stylesheet" href="../dossier_css/header.css">
   <link rel="stylesheet" href="../dossier_css/footer.css">
   <link rel="stylesheet" href="../dossier_css/dasbord.css">
   <link rel="stylesheet" href="../dossier_css/produit.css">
   <link rel="stylesheet" href="../dossier_css/vendeur.css">
   <link rel="stylesheet" href="../dossier_css/fournisseur.css">
</head>
<body>
    <?php include "../config.php" ?>
    <?php include "../compenant/nav.php"  ?>
    <?php include "../compenant/header.php" ?>
    <?php include "../traitement/traite.php"  ?>
    <?php include "../traitement/traite_ajoutVendeur.php" ?>
    <?php include "../traitement/traite_client.php" ?>
    <?php include "../pages/deconnexion.php" ?>
    <?php include "../pages/produit.php" ?>
    <?php include "../pages/vendeur.php" ?>
    <?php include "../pages/fournisseur.php" ?>
    <?php include "../pages/supprimer_vendeur.php" ?>
    <?php include "../traitement/traite_categorie.php" ?>
   
</body>
      <script src="../dossier_js/script.js"></script>
      <script src="../dossier_js/filter.js"></script>
<script src="../dossier_js/fournisseur.js"></script>
</html>