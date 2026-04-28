<?php
    session_start();
include '../config.php';

$id_commande = $_GET['id'];
$sql = "SELECT date_commande FROM commande WHERE id = ?";

$sql = "SELECT d.quantite, d.prix, d.sous_total, p.nom 
        FROM detailcommande d 
        JOIN produit p ON d.id_produit = p.id 
        WHERE d.id_commande = ?";

$req = $db->prepare($sql);
$req->execute([$id_commande]);

$total_general = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Facture</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    padding: 20px;
}
.facture {
    width: 700px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th {
    background: #007bff;
    color: white;
    padding: 10px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f1f1f1;
}

.total {
    text-align: right;
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
}

.btn {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background: green;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.fac{
    display: flex;
    justify-content: space-between;
}

.btn:hover {
    background: darkgreen;
}

/* Impression */
@media print {
    .btn {
        display: none;
    }
}
</style>
</head>
<body>
       <div class="facture">
           <div class="fac">
               <div>
                   <h1>🧾Facture</h1> 
                   <p>N°012900<?= $id_commande ?></p>
                   <p>date:<?= date('d/m/y') ?></p>
                   <p>Facture a:</p>
                   <p>Nom: </p>
               </div>
               <div>
                   <h2>mon etreprise</h2> 
                   <p>Rue de Dakar</p>
                   <p>Tel:+221 766267577</p>
               </div>
           </div>
           <h2>🧾Facture commande </h2>
           <table>
               <tr>
                   <th>Produit</th>
                   <th>Quantité</th>
                   <th>Prix</th>
                   <th>Total</th>
               </tr>
               <?php while($row = $req->fetch()): 
                   $total_general += $row['sous_total'];
               ?>
               <tr>
                   <td><?= $row['nom'] ?></td>
                   <td><?= $row['quantite'] ?></td>
                   <td><?= $row['prix'] ?> FCFA</td>
                   <td><?= $row['sous_total'] ?> FCFA</td>
               </tr>
               <?php endwhile; ?>
           </table>
           <div class="total">
               Total général : <?= $total_general ?> FCFA
           </div>
           <button class="btn" onclick="window.print()">🖨️Imprimer</button>
       </div>
</body>
</html>