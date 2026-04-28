<?php
session_start();
include "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Supprimer d'abord les détails de la commande
    $sql = "DELETE FROM detailcommande WHERE id_commande = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    
    // Ensuite supprimer la commande elle-même
    $sql = "DELETE FROM commande WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    
    header("Location: commande.php");
    exit();
}
?>
