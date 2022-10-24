<?php
session_start();
$plugin="projet_web_securite";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <?php
    if (!isset($_SESSION['mail_user'])) {
      header('location:authentification.php');
    };

    $_SESSION["mail_user"]

    ?>
    <title>Bienvenue</title>
  </head>
  <body>
    <div id="title">
      <h1>Blog</h1>
      <h2>Connecté en tant que <?php echo $_SESSION["mail_user"] ?></h2>
    </div>
    <div id="connexion" >
        <a href="deconnexion.php">Déconnexion</a>
    </div>
  </body>
</html>
