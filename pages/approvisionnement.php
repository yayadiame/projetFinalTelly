<?php 
session_start();
include "../config.php"; 
$sql="SELECT id, nom, prenom FROM fournisseur ";
   $query = $db->query($sql);
   $fournis = $query->fetchAll(PDO::FETCH_ASSOC);
   $sql = "SELECT id, nom, prix_vente  FROM produit";
    $query = $db->query($sql);
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);
//pour le jointure des approvisionnement et detailappro 
$sql = "SELECT a.id, a.status, a.date as date, CONCAT(f.prenom, ' ', f.nom) as fournisseur 
    FROM approvissionnement a 
    JOIN fournisseur f ON a.id_fournisseur = f.id 
    ORDER BY a.id DESC";
$query_appro = $db->query($sql);
$appros = $query_appro->fetchAll(PDO::FETCH_ASSOC);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../dossier_css/nav.css">
    <!-- <link rel="stylesheet" href="../dossier_css/header.css"> -->
    <link rel="stylesheet" href="../dossier_css/footer.css">
    <link rel="stylesheet" href="../dossier_css/dasbord.css">
    <link rel="stylesheet" href="../dossier_css/fournisseur.css">
    <link rel="stylesheet" href="../dossier_css/appro.css">
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
    <section class="appro">
        <div class="card_add">
            <input type="text" placeholder="Filtrer par nom........." class="texte">
            <button class="addappro">Nouveau Appro</button>
        </div>
       <div class="formAppro">
         <form action="../traitement/traite_appro.php" method="post">
            <strong class="supp">X</strong>
            <h2>Approvisionnement</h2>
            <!-- FOURNISSEUR -->
            <label>Fournisseur :</label>
            <select name="id_fournisseur" id="id_fournisseur">
                <option value="">-- Fournisseurs --</option>
                <?php foreach($fournis as $fourni): ?>
                <option value="<?= $fourni['id'] ?>"><?= $fourni['prenom'] ?> <?= $fourni['nom'] ?></option>
                <?php endforeach; ?>
            </select>
            <!-- PRODUITS -->
            <label style="margin-top:15px;">Produits :</label>
            <div id="listeProduits">
                <div class="ligne">
                    <select name="produits[]">
                        <option value="">-- Produit --</option>
                        <?php foreach($produits as $prod): ?>
                            <option value="<?= $prod['id']; ?>">
                                <?= $prod['nom'] . ' - ' . $prod['prix_vente'] . ' FCFA'; ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                    <input type="number" name="quantites[]" placeholder="Qté">
                    <button type="button" class="supprimer" onclick="supprimerLigne(this)">X</button>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="ajouterLigne()">+ Ajouter produit</button>
            <button type="submit" class="submit-btn"  onclick = "return confirm('votre formulaire est validé avec succés !')">Valider</button>
         </form>
       </div>
        <table>
            <thead>
                <th>Fournisseur</th>
                <th>date</th>
                <th>status</th>
                <th>Action</th>
            </thead>
            <?php foreach($appros as $appro): ?>
            <tr>
                <td><?= htmlspecialchars($appro['fournisseur'])?></td>
                <td><?= htmlspecialchars($appro['date'])?></td>
                 <td>
                <?php if($appro['status'] == 'en_cours'): ?>
                    <span style="color:orange;">En cours</span>
                <?php else: ?>
                    <span style="color:green;">Validé</span>
                <?php endif; ?>
                </td>
                <td class="supAppro">
                    <a href="../pages/mod_appro.php?id=<?=$appro["id"]?>" class="btn-mod"><i class="fa-solid fa-pen"></i></a>
                    <a href="../pages/supprimer_appro.php?id=<?=$appro["id"]?>" class="btn-annuler"  onclick = "return confirm('voulez vous vraiment supprimer cet approvisionnement ?')"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </section>
</body>
<script src="../dossier_js/appro.js"></script>
</html>