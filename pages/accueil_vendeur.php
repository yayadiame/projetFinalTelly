<?php
session_start();
    include "../config.php";
if(!isset($_SESSION['user'])){
    header('Location: connexion.php');
    exit();
}
   //produit 
   $sql="SELECT p.nom AS produit, cat.nom AS categorie, SUM(lc.quantite) AS total_quantite FROM detailcommande lc
 JOIN produit p ON lc.id_produit = p.id
 JOIN categorie cat ON p.id_categorie = cat.id
 GROUP BY p.id
 ORDER BY total_quantite DESC
 LIMIT 10";
 $produits = $db->prepare($sql);
 $produits->execute();

     //les 10 meilleurs commandes 
      $sql = "SELECT c.nom, cm.date, d.sous_total AS detailcommande 
      FROM commande cm
      JOIN client c ON cm.id_client = c.id
      JOIN detailcommande d ON d.id_commande = cm.id
      ORDER BY cm.id DESC
      LIMIT 10";
      $cms = $db->prepare($sql);
      $cms->execute();

// total des clients 
$totalQuery = $db->query("SELECT COUNT(*) as total FROM client");
$total = $totalQuery->fetch()['total'];
 
    //la total des commandes 
    $totalQuery = $db->query("SELECT COUNT(*) as total FROM commande");
   $cmmds = $totalQuery->fetch()['total'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Vendeur</title>
    <link rel="stylesheet" href="../dossier_css/nav.css">
    <link rel="stylesheet" href="../dossier_css/dasbord.css">
    <link rel="stylesheet" href="../dossier_css/dasbord_vendeur.css">
</head>
<body>
   <?php include "../compenant/nav.php"; ?>
   <?php include "../compenant/dasbord.php";?>
   <section class="carte_vends">
        <div class="Card_grid">
            <div class="card1">
                <div>Commandes</div>
                <h3><?= $cmmds; ?></h3>
            </div>
            <div class="card1">
                <div>vente</div>
                <h3>5</h3>
            </div>
            <div class="card1">
                <div>Chiffres d'affaires</div>
                <h3>52546F</h3>
            </div>
            <div class="card1">
                <div>Client Total</div>
                <h3><?= $total;?></h3>
            </div>
         </div>
          <div class="card_vends">
            <h2><i class="fa-solid fa-cart-shopping"></i>Top 10 Produits les PLUS  vendus</h2>
            <table>
                <thead class="lignes">
                    <th>RANG</th>
                    <th>PRODUITS</th>
                    <th>CATEGORIE</th>
                    <th>QUANTITE</th>
                </thead>
                 <?php 
                 $rang=1;
                 while($produis = $produits->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $rang ++ ?></td>
                    <td><?= $produis['produit'] ?></td>
                    <td><?= $produis['categorie'] ?></td>
                    <td><?= $produis['total_quantite'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div class="card_vends">
            <h2><i class="fa-solid fa-receipt"></i> Top 10 Meilleures Commandes</h2>
            <table>
                <thead class="lignes">
                    <th>Rang</th>
                    <th>Client</th>
                    <th>DATE</th>
                    <th>MONTANT</th>
                </thead>
            <?php $rang=1;
             while($rows = $cms->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $rang++ ?></td>
                <td><?= $rows['nom'] ?></td>
                <td><?= $rows['date'] ?></td>
                <td><?= $rows['detailcommande'] ?></td>
            </tr>
            <?php endwhile; ?>
            </table>
        </div>
   </section>
</body>
</html>