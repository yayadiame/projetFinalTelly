<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Vendeur</title>
    <link rel="stylesheet" href="../dossier_css/nav.css">
    <link rel="stylesheet" href="../dossier_css/dasbord.css">
    <!-- <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; color: #1f2937; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 30px; }
        h1 { margin-top: 0; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style> -->
</head>
<body>
   <?php include "../compenant/nav.php"; ?>
   <?php include "../compenant/dasbord.php";?>
</body>
</html>