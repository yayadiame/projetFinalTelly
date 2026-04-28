<?php
  include "../config.php";
        //commande 
$sql = "SELECT c.nom,  cm.etat, cm.date 
FROM commande cm 
JOIN client c ON cm.id_client = c.id 
ORDER BY cm.id DESC 
LIMIT 10";

$cmds = $db->prepare($sql);
$cmds->execute();
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

   // top 10 les meilleurs clients 
    $sql = "SELECT c.nom, COUNT(cm.id) AS id_commande, SUM(d.sous_total) AS detailcommande
  FROM commande cm
  JOIN client c ON cm.id_client = c.id
  JOIN detailcommande d ON d.id_commande = cm.id
  GROUP BY c.id
  ORDER BY detailcommande DESC
  LIMIT 10";

$cls = $db->prepare($sql);
$cls->execute();

//stock 
   $sql=" SELECT nom,seuil FROM produit WHERE seuil 
ORDER BY seuil ASC";
$ruptures = $db->prepare($sql);
$ruptures->execute();
?>
<section class="section1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- session1 cest la balise parent  -->
   <div class="Dasbord">
      <h2>Dashbord Admin</h2>
     <input type="text" placeholder=" chercher 🔍........" class="filter_card">
     <img src="../dossier_images/avatar1773365304.jpg" alt="profil" class="card_imge">
   </div>
   <div class="card_grid">
     <div class="card-A">
         <div>chiffres d'affaires</div>
         <h3>5</h3>
     </div>
     <div class="card-A">
         <div>vente du jour</div>
         <h3>5</h3>
     </div>
     <div class="card-A">
         <div>moyen</div>
         <h3>52546F</h3>
     </div>
     <div class="card-A">
         <div>Client Total</div>
         <h3>5</h3>
     </div>
   </div>
   <div class="diagramme">
        <div class="div1">
        <canvas id="graphique"></canvas>
        </div>
        <div class="div2">
            <canvas id="cercle"></canvas>
        </div>
    </div>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
const data = {
    labels: ['Lundi', 'Mardi', 'Mercredi', 'jeudi' , 'vendredi', 'samedi', 'Dimanche'],
    datasets: [{
        label: 'Ventes',
        data: [12, 19, 3, 5],
        borderWidth: 2
    }]
};

const ctx = document.getElementById('graphique').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: data
});

const ctx2 = document.getElementById('cercle').getContext('2d');

new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['client', 'produit', 'vendeur'],
        datasets: [{
            data: [10, 20, 30]
        }]
    }
});
</script>
</section> 
<section  class="section1">
    <div class="card_king">
        <div class="card_vends">
            <h2>Top 10 Meilleures Commandes</h2>
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
        <div class="card_vends">
            <h2>Top 10 Produits les PLUS  vendus</h2>
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
    </div>
</section> 
<section class="section1">
<div class="card_kings">
    <div class="card_cmdes">
        <h2>PRODUITS EN RUPTURE</h2>
        <table>
            <thead class="lignes">
                <tr>
                    <th>Produit</th>
                    <th>Stock</th>
                    <th>Alerte</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ruptures as $rupt): ?>
                <tr>
                    <td><?= $rupt['nom'] ?></td>
                    <td><?= $rupt['seuil'] ?></td>
                    <td>
                        <?php if($rupt['seuil']  <=10): ?>
                            <span style="color:red;">Rupture</span>
                        <?php else: ?>
                            <span style="color:green;">stock</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</section>
<section class="section1">
        <div class="card_king">
        <div class="card_cmde">
            <h2>Top 10 Meilleures Clients</h2>
            <table>
                <thead class="lignes">
                    <th>Rang</th>
                    <th>CLIENTS</th>
                    <th>Commande</th>
                    <th>CA TOTAL</th>
                </thead>
                <?php $rang=1;
                while($rls = $cls->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $rang++ ?></td>
                    <td><?= $rls['nom'] ?></td>
                    <td><?= $rls['id_commande'] ?></td>
                    <td><?= $rls['detailcommande'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div class="card_cmde">
            <h2>10 Derniers Commandes</h2>
            <table>
                <thead class="lignes">
                    <th>Rang</th>
                    <th>CLIENT</th>
                    <th>ETAT</th>
                    <th>DATE</th>
                </thead>
            <?php $rang=1;
             while($row = $cmds->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $rang++ ?></td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['etat'] ?></td>
                <td><?= $row['date'] ?></td>
            </tr>
            <?php endwhile; ?>
            </table>
        </div>
    </div>
    <br><br><br><br><br>
</section>


 
