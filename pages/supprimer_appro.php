<?php
session_start();
 include "../config.php";
  $id=$_GET['id'];

  $diel= $db->prepare("DELETE FROM detailappro WHERE id_appro=:id");
    $diel->execute(['id'=>$id]);
  $sql= "DELETE FROM approvissionnement WHERE id=:id";
  $prepare=$db->prepare($sql);
  $prepare->execute(['id'=>$id]);
  header('location:../pages/approvisionnement.php');
  exit();














  // supprimer les détails
// $del = $db->prepare("DELETE FROM detailappro WHERE id_appro = :id");
// $del->execute(['id' => $id]);

// puis supprimer le parent
// $sql = "DELETE FROM approvissionnement WHERE id = :id";
// $prepare = $db->prepare($sql);
// $prepare->execute(['id' => $id]);