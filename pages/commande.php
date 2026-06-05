<?php
session_start();
    include "../config.php";

    // Récupérer toutes les commandes avec client et total
    $sql = "SELECT c.id, c.date, c.etat, cl.nom, cl.prenom, SUM(dc.sous_total)  as total
            FROM commande c
            JOIN client cl ON c.id_client = cl.id
            LEFT JOIN detailcommande dc ON c.id = dc.id_commande
            GROUP BY c.id
            ORDER BY c.date DESC";
    $query = $db->query($sql);
    $commandes = $query->fetchAll(PDO::FETCH_ASSOC);

    //les commdes genre cloturee , annuleer etc ...............
    $sqlStats = "SELECT etat, COUNT(*) as total FROM commande GROUP BY etat";
$queryStats = $db->query($sqlStats);
$stats = $queryStats->fetchAll(PDO::FETCH_ASSOC);

$attente = 0;
$cloturee = 0;
$annulee = 0;
if($_SESSION['user']['role'] === 'vendeur'){
    foreach($stats as $srow){
    if($srow['etat'] == "en_cours") $attente = $srow['total'];
    if($srow['etat'] == "cloture") $cloturee = $srow['total'];
    if($srow['etat'] == "annuler") $annulee = $srow['total'];
}
}
if($_SESSION['user']['role'] === 'admin'){
    foreach($stats as $srow){
    if($srow['etat'] == "en_cours") $attente = $srow['total'];
    if($srow['etat'] == "cloture") $cloturee = $srow['total'];
    if($srow['etat'] == "annuler") $annulee = $srow['total'];
}
} 
    
    // Récupérer les produits
    $sql = "SELECT id, nom, prix_vente  FROM produit";
    $query = $db->query($sql);
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les clients
    $sql_clients = "SELECT * FROM client";
    $query_clients = $db->query($sql_clients);
    $clients = $query_clients->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../dossier_css/nav.css">
   <!-- <link rel="stylesheet" href="../dossier_css/header.css"> -->
   <link rel="stylesheet" href="../dossier_css/footer.css">
   <link rel="stylesheet" href="../dossier_css/dasbord.css">
   <link rel="stylesheet" href="../dossier_css/commande.css">
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
    <div class="card-commande">
        <div class="divDasbord">
            <div class="div3" style="">
                <div class="p">
                    <p><i class="fa-solid fa-clock"></i></p>
                   <p>en attente</p> 
                </div>
                <h3><?= $attente ?></h3>
            </div>
            <div class="div1" style="">
                <div class="p">
                    <p><i class="fa-solid fa-check"></i></p>
                    <p>cloturée</p>
                </div>
                <h3><?= $cloturee ?></h3>
            </div>
            <div class="div2" style="">
                <div class="p">
                    <p><i class="fa-solid fa-xmark"></i></p>
                    <p>Annulée</p>
                </div>
                <h3><?= $annulee ?></h3>
            </div>
        </div>
        <div class="listes-commande">
            <input type="text" class="texte" placeholder="  🔍 filtrer par nom ............. ">
            <button class="commande"><i class="fa-solid fa-plus"></i>Add Commande </button>
        </div>
        <div class="formCommande">
          <form action="../traitement/traite_commande.php" method="post">
          <h2>Formulaire Commandes</h2>
          <strong class="x">X</strong>
                      <!-- CLIENT -->
            <label>Client :</label>
            <select name="noms" id="client" required>
                <option value="">-- Choisir un client --</option>
             <?php foreach ($clients as $client): ?>
            <option value="<?= $client['id']; ?>"><?= $client['nom'] . ' ' . $client['prenom']; ?></option>
             <?php endforeach;?>
            </select>
            <br><br>
            <!-- PRODUITS -->
            <label>Produits :</label>
            <div id="listeProduits">
                <div class="ligne">
                    <select name="produits[]">
                        <option value="">-- Produit --</option>
                        <?php foreach($produits as $prod): ?>
                            <option value="<?= $prod['id']; ?>"><?= $prod['nom'] . ' - ' . $prod['prix_vente'] . ' FCFA'; ?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="number" name="quantites[]" placeholder="Quantité">
                    <button type="button" class="supprimer" onclick="supprimerLigne(this)">X</button>
                </div>
            </div>
            <div class="flex">
            <button type="button" class="ajouter" onclick="ajouterLigne()">+ Ajouter produit</button>
            <!-- <h3>Total: </h3> -->
            </div><br>
            <button type="submit" class="addCommande" onclick = "return confirm('votre commande est créée avec succés !')" >Créer commande</button>
             </form>
        </div>
        <!-- le tableau des commandes -->
         <table>
            <thead>
                <th>Client</th>
                <th>Date</th>
                <th>prix total</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($commandes as $cmd): ?>
                <tr>
                    <td><?= htmlspecialchars($cmd['nom'] . ' ' . $cmd['prenom']); ?></td>
                    <td><?= htmlspecialchars($cmd['date']); ?></td>
                    <td><?= htmlspecialchars($cmd['total'] ?? 0); ?> FCFA</td>
                    <td><?= htmlspecialchars($cmd['etat']); ?></td> 
                    <td>
                    <?php if($cmd['etat']=="en_cours"): ?>
                        <a href="mod_fac.php?id=<?= $cmd['id'] ?>">Modifier</a>
                        <a href="supprimer_fac.php?id=<?= $cmd['id'] ?>" class="supprimer">Supprimer</a>
                        <a href="annuler_fac.php?id=<?= $cmd['id'] ?>" class="annuler">Annuler</a>
                        <a href="cloture.php?id=<?= $cmd['id'] ?>">Clôturer</a>
                    <?php endif; ?>

                    <?php if($cmd['etat']=="cloture"): ?> 
                        <a href="facture.php?id=<?= $cmd['id'] ?>">Facture</a>
                    <?php endif; ?>

                    <?php if($cmd['etat']=="annuler"): ?>
                         <span class="annuler" style="color:red;">Annulée</span>
                    <?php endif; ?>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
         </table>
    </div>
</body>
<script>
    var produits = <?php echo json_encode($produits); ?>;
</script>
<script src="../dossier_js/commande.js"></script>
</html>