<?php
session_start();
// if(!isset($_SESSION['user'])){
//     header("Location:../pages/connexion.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            background: #021c2b;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 800px;
            height: 400px;
            display: flex;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px #00f7ffbb;
        }

        /* Partie gauche */
        .gauche {
            width: 50%;
            background: #031f33;
            padding: 40px;
            color: white;
        }

        .gauche h2 {
            margin-bottom: 30px;
        }

        .inputBox {
            position: relative;
            margin-bottom: 25px;
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1px solid #00f7ff;
            outline: none;
            color: white;
            border-radius: 5px;
        }

        .inputBox label {
            position: absolute;
            top: -10px;
            left: 10px;
            background: #031f33;
            padding: 0 5px;
            font-size: 12px;
            color: #00f7ff;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background: linear-gradient(to right, #00f7ff, #0066ff);
            color: white;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* button:hover {
            opacity: 0.8;
        } */

        .gauche p {
            margin-top: 15px;
            font-size: 12px;
        }

        .gauche span {
            color: #00f7ff;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        /* Partie droite */
        .droite {
            width: 50%;
            background: linear-gradient(135deg, #001f3f, #00f7ff);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
        }

        .droite h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .droite p {
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">
    <!-- FORMULAIRE -->
    <div class="gauche">
        <h2>Connexion</h2>
        <!-- Message erreur -->
        <?php if(isset($_SESSION["error"])): ?>
            <p class="error">
                <?php 
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                ?>
            </p>
        <?php elseif(isset($_SESSION["success"])): ?>
        <p style="color:green; text-align:center; font-size:18px;">
            <?php 
                echo $_SESSION["success"];
                unset($_SESSION["success"]);
            ?>
        </p>
         <?php endif; ?>
        <form action="../traitement/traite.php" method="POST">
            <div class="inputBox">
                <input type="email" name="email" placeholder="votre email">
                <label>Email</label>
            </div>
            <div class="inputBox">
                <input type="password" name="mot_de_passe" placeholder="votre password">
                <label>Mot de passe</label>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte ? <span>S'inscrire</span></p>
    </div>
    <!-- PARTIE DROITE -->
    <div class="droite">
        <h1>BIENVENUE !</h1>
        <p>Entrez vos informations pour continuer</p>
    </div>
</div>
</body>
</html>