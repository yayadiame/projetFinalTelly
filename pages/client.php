<?php
session_start();

include "../config.php";
  
// pagination
$limit = 3; // nombre de clients par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;
// récupérer les clients avec limite
$sql = "SELECT * FROM client LIMIT $start, $limit";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
// total des clients
$totalQuery = $db->query("SELECT COUNT(*) as total FROM client");
$total = $totalQuery->fetch()['total'];
// nombre de pages
$totalPages = ceil($total / $limit);
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
   <link rel="stylesheet" href="../dossier_css/client.css">
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
    <section class="card-client">
        <div class="div-dasbord">
            <div class="grene">
                <div>vente du jour</div>
                <h3>5</h3>
            </div>
            <div class="grene">
                <div>moyen</div>
                <h3>52546F</h3>
            </div>
            <div class="grene">
                <div>Client Total</div>
                <h3>5</h3>
            </div>
        </div>
        <div class="formClient">
            <form action="../traitement/traite_client.php" method="POST" enctype="multipart/form-data">
                <h2>Ajouter Client</h2>
                <?php if(isset($_SESSION['error'])){ echo '<div style="color:red; text-align:center; margin:10px;">'.$_SESSION['error'].'</div>'; unset($_SESSION['error']); } ?>
                <input type="file" name="file">
                <input type="text" name="nom" placeholder="entrer votre nom">
                <input type="text" name="prenom" placeholder="entrer votre prenom">
                <input type="text" name="tel" placeholder="entrer votre number">
                <div class="btn-parent">
                        <button type="button" class="btnAnnuler"><i class="fa-solid fa-xmark"></i> Annuler</button>
                        <button type="submit" class="addClient"><i class="fa-solid fa-plus"></i>Add Client</button>
                    </div>
            </form>
        </div>
        <div class="listes-client">
            <input type="text" class="texte" placeholder="  🔍 filtrer par nom ........">
             <?php if($_SESSION['user']['role'] === 'admin'): ?>
            <button class="client"><i class="fa-solid fa-plus"></i>Add Client </button>
             <?php endif; ?>
        </div>
        <table>
            <thead class="lignes">
                <th>profil</th>
                <th>Nom</th>
                <th>prenom</th>
                <th>Telephone</th>
                 <?php if($_SESSION['user']['role'] === 'admin'): ?>
                <th>action</th>
                 <?php endif; ?>
            </thead>
            <tbody>
                <?php foreach($users as $user):?>
                <tr>
                    <td><img src="../dossier_images/<?= $user['profil']?>" alt="" class="avatar"></td>
                    <td><?= $user['nom']?></td>
                    <td><?= $user['prenom']?></td>
                    <td><?= $user['tel']?></td>
                     <?php if($_SESSION['user']['role'] === 'admin'): ?>
                    <td class="btn-cil">
                        <a href="../pages/mod_client.php?id=<?= $user['id']?>" class="btn-mod"><i class="fa-solid fa-pen"></i></a>
                        <a href="../pages/supprimer_client.php?id=<?= $user['id']?>" class="btn-annuler"  onclick = "return confirm('voulez vous vraiment supprimer ce client ?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                     <?php endif; ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="pagination">

    <!-- précédent -->
    <?php if($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="page-link">«</a>
    <?php endif; ?>
    <!-- pages -->
    <?php for($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" 
           class="page-link <?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
    <!-- suivant -->
    <?php if($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="page-link">»</a>
    <?php endif; ?>

</div>
        
    </section>
    <script src="../dossier_js/script.js"></script>
    <script src="../dossier_js/filter.js"></script>
</body>
</html>