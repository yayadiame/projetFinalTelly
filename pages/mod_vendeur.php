<?php
session_start();
    include "../config.php";
$id=$_GET['id'];
$sql="SELECT * FROM users WHERE  id=:id";
$preparer=$db->prepare($sql);
$preparer->execute(['id'=>$id]);
$vendeur=$preparer->fetch();
?>
<style>
    
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}
body{
    background-color: #001f3f;
}

/* Overlay */
.add-vendeur{
    background: rgba(0, 0, 0, 0.6);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
}

/* Formulaire */
.add-vendeur form{
    background-color: #fff;
    padding: 25px;
    border-radius: 15px;
    width: 420px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    animation: fadeIn 0.4s ease;
}

/* Animation */
@keyframes fadeIn{
    from{
        opacity: 0;
        transform: translateY(-20px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header */
.crad-inscire{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

h2{
    color: #001f3f;
    font-size: 20px;
}

/* Bouton fermer */
.btnAnnuler{
    background: red;
    color: white;
    width: 35px;
    height: 35px;
    font-size: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.3s;
}

.btnAnnuler:hover{
    background: #cc0000;
    transform: scale(1.1);
}

/* Inputs */
.add-vendeur input,
.add-vendeur select{
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    transition: 0.3s;
}

.add-vendeur input:focus,
.add-vendeur select:focus{
    border-color: #001f3f;
    outline: none;
    box-shadow: 0 0 5px rgba(0,31,63,0.3);
}

/* Bouton submit */
.btn-add{
    margin-top: 15px;
    padding: 10px;
    border-radius: 8px;
    background-color: #001f3f;
    color: white;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 100%;
    transition: 0.3s;
}

.btn-add:hover{
    background-color: #003366;
    transform: scale(1.05);
}

/* Messages */
h5{
    text-align: center;
    margin-top: 5px;
}

/* File input */
input[type="file"]{
    background-color: #f1f1f1;
    cursor: pointer;
}
</style>
<section class="add-vendeur">
  <form action="../traitement/traite_modVendeur.php" method="post" enctype="multipart/form-data">
  <div class="crad-inscire">
      <h2>Modifier-Vendeur</h2>
      <strong class="btnAnnuler" onclick="window.history.back()">X</strong>
  </div>
      <p style="color:red; padding: 10px; text-Align:center">
          <?php if(isset($_SESSION["error"])){
          echo $_SESSION["error"];
          unset($_SESSION["error"]);
      } ?></p>
      <div class="div1">
          <input type="hidden" name="id" value="<?= $vendeur['id']?>">
          <input type="file" value="" name="file"> <br>
      </div>
      <div class="div2">
          <input type="text" value="<?= $vendeur['nom']?>" name="nom" placeholder="entrer votre nom"> <br>
          <input type="text" value="<?= $vendeur['prenom']?>" name="prenom" placeholder="entrer votre prenom"> <br>
      </div>
      <div class="div3">
          <input type="email" value="<?= $vendeur['email']?>" name="email" placeholder="entrer votre email"> <br>
          <input type="password" value="<?= $vendeur['mot_de_passe']?>" name="mot_de_passe" placeholder="*****"> <br>
      </div>
      <select name="role" id="role">
              <option value="vendeur">Vendeur</option>
              <!-- <option value="admin">Admin</option> -->
          </select><br>
          <div class="btn-parent">
            <h5 style="color:red;"><?php if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION["message"]);
            } ?></h5>
              <button type="submit" class="btn-add"><i class="fa-solid fa-plus"></i>Modifier Vendeur</button>
               <!-- <script src=" onclick()= "></script> -->
          </div>
  </form>
</section>