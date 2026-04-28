<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<nav>
    <?php if($_SESSION['user']['role'] === 'admin'): ?>
    <strong><span> ADMIN</span></strong>
    <?php endif; ?>

    <?php if($_SESSION['user']['role'] === 'vendeur'): ?>
    <strong><span> VENDEUR</span></strong>
    <?php endif; ?>

<ul>

<?php if($_SESSION['user']['role'] === 'admin'): ?>
<li><a class="active" href="accueil.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>

<li><a href="vendeur.php"><i class="fa-solid fa-user-gear"></i> Vendeurs</a></li>

<li><a href="fournisseur.php"><i class="fa-solid fa-truck-fast"></i> Fournisseurs</a></li>

<li><a href="approvisionnement.php"><i class="fa-solid fa-dolly"></i> Approvisionnement</a></li>
<?php endif; ?> 

<?php if($_SESSION['user']['role'] === 'vendeur'): ?>
<li><a class="active" href="accueil_vendeur.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
<?php endif; ?>

<li><a href="produit.php"><i class="fa-solid fa-box-open"></i> Produits & Catégories</a></li>

<li><a href="client.php"><i class="fa-solid fa-user-group"></i> Clients</a></li>

<li><a href="commande.php"><i class="fa-solid fa-receipt"></i> Commandes & Factures</a></li>

<li><a href="deconnexion.php" class="btn-nav">
    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
</a></li>

</ul>
</nav>