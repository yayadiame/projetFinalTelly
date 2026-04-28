<?php
session_start();
    include "../config.php";

// nombre d'éléments par page
$limit = 3;
// récupérer la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// calcul du début
$start = ($page - 1) * $limit;
// récupérer les utilisateurs LIMITÉS
$sql = "SELECT * FROM users WHERE role= 'vendeur' LIMIT $start, $limit";
$query = $db->query($sql);
$users = $query->fetchAll(PDO::FETCH_ASSOC);
// compter le total des utilisateurs
$totalQuery = $db->query("SELECT COUNT(*) as total FROM users");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../dossier_css/nav.css">
   <link rel="stylesheet" href="../dossier_css/dasbord.css">
   <link rel="stylesheet" href="../dossier_css/footer.css">
   <!-- <link rel="stylesheet" href="../dossier_css/dasbord.css"> -->
   <link rel="stylesheet" href="../dossier_css/vendeur.css">
   <link rel="stylesheet" href="../dossier_css/ajouterVendeur.css">
   <!-- <link rel="stylesheet" href="../dossier_css/ajouterVendeur.css"> -->
</head>
<body>
    <?php include "../compenant/nav.php" ?>
    <?php include "../compenant/dasbord.php" ?>
    <section class="card-vendeur">
        <div class="div-listes">
            <input type="text" class="texte" placeholder=" 🔍 filtrer par nom ...">
            <button class="vendeurs"><i class="fa-solid fa-plus"></i> Add Vendeur </button>
        </div>
        <section class="add-vendeur">
            <form action="../traitement/traite_ajoutVendeur.php" method="post" enctype="multipart/form-data">
            <div class="crad-inscire">
                <h2>Ajouter-Vendeur</h2>
            </div>
                <p style="color:red; padding: 10px; text-Align:center">
                    <?php if(isset($_SESSION["error"])){
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                } ?></p>
                <div class="div1">
                    <input type="file" name="file"> <br>
                </div>
                <div class="div2">
                    <input type="text" name="nom" placeholder="entrer votre nom"> <br>
                    <input type="text" name="prenom" placeholder="entrer votre prenom"> <br>
                </div>
                <div class="div3">
                    <input type="email" name="email" placeholder="entrer votre email"> <br>
                    <input type="password" name="mot_de_passe" placeholder="*****"> <br>
                </div>
                <select name="role" id="role">
                        <option value="vendeur">Vendeur</option>
                        <option value="admin">Admin</option>
                    </select><br>
                    <div class="btn-parent">
                        <button type="button" class="btnAnnuler"><i class="fa-solid fa-xmark"></i> Annuler</button>
                        <button type="submit" class="btn-add"><i class="fa-solid fa-plus"></i>Add Vendeur</button>
                    </div>
            </form>
        </section>
        <table>
            <thead class="lignes">
                <th>profil</th>
                <th>Nom</th>
                <th>prenom</th>
                <th>email</th>
                <th>action</th>
            </thead>
            <tbody>
                <?php foreach($users as $user):?>
                <tr>
                    <td><img src="../dossier_images/<?= $user['profil']?>" alt="" class="profil-img"></td>
                    <td><?= $user['nom']?></td>
                    <td><?= $user['prenom']?></td>
                    <td><?= $user['email']?></td>
                    <td class="card_mod_sup">
                        <a href="../pages/mod_vendeur.php?id=<?=$user["id"]?>" class="btn-mod"><i class="fa-solid fa-pen"></i></a>
                        <a href="../pages/supprimer_vendeur.php?id=<?=$user["id"]?>" class="btn-annuler"  onclick = "return confirm('voulez vous vraiment supprimer ce vendeur ?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                 <?php endforeach;?>
            </tbody>
        </table>
       <div class="pagination">
        <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" 
            class="page-link <?= ($i == $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
            <?php endfor; ?>
        </div>
    </section>
<script src="../dossier_js/script.js"></script>
<script src="../dossier_js/filter.js"></script>

</body>
</html>