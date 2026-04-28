<?php 

session_start();

include "../config.php";

$sql = "SELECT * FROM fournisseur";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../dossier_css/fournisseur.css">
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
    <section class="Fournisseur">
        <div class="div-fournisseur">
            <input type="text" class="texte" placeholder=" 🔍 filtrer par nom ...">
            <button class="fournisseur"><i class="fa-solid fa-plus"></i> Add fournisseur </button>
        </div>
        <div class="formfourni">
            <form action="../traitement/traite_fournisseur.php" method="post">
                <strong class="btnAnnuler">X</strong> <br> <br>
                <h2>Ajouter Fournisseur</h2>
                <input type="text" name="nom" placeholder="ex: diall0"> <br>
                <input type="text" name="prenom" placeholder="ex: yaya.."> <br>
                <input type="number" name="tel" placeholder="ex: 7662675.."> <br>
                <button class="addFourni"> Add fournisseur</button>
            </form>
        </div>
        <table  class="lignes">
            <thead>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Tel</th>
                <th>Action</th>
            </thead>
            <?php foreach($users as $user) :?>
                <tr>
                    <td><?= $user['nom']?></td>
                    <td><?= $user['prenom']?></td>
                    <td><?= $user['tel']?></td>
                    <td class="btn-four">
                        <a href="../pages/mod_fourni.php?id=<?= $user['id']?>" class="btn-mode"><i class="fa-solid fa-pen"></i></a>
                        <a href="../pages/supprimer_fourni.php?id=<?= $user['id']?>" class="btn-annule" onclick = "return confirm('voulez vous vraiment supprimer ce fournisseur ?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </section>
</body>
<script src="../dossier_js/fournisseur.js"></script>
<script src="../dossier_js/filter.js"></script>
</html>