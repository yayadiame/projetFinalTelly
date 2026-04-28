<?php
session_start();
include "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // On change seulement l'état
    $sql = "UPDATE commande SET etat = 'annuler' WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    header("Location: commande.php");
    exit();
}
?>
