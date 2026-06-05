<?php
$host="localhost";
$user="root";
$password="";
$dbname="final_projettelly";

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );
    // echo"connexion reussie";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
