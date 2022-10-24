<?php
session_start();

require "config/database.php";

$authmsg="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$mail_user=$_POST["mail_user"];
	$password=$_POST["pwd_user"];
  $nom_user=$_POST["nom_user"];
	$prenom_user=$_POST["prenom_user"];
  $tel_user=$_POST["tel_user"];
	$adresse_user=$_POST["adresse_user"];
  $cp_user=$_POST["cp_user"];
	$ville_user=$_POST["ville_user"];
  $description_user=$_POST["description_user"];


  $sql = $bdd->prepare("INSERT INTO user VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$sql->execute(array(NULL, $mail_user, $password, $nom_user, $prenom_user, $tel_user, $adresse_user, $cp_user, $ville_user, $description_user));

}
$bdd = null;
?>


<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet"/>
</head>
<body>
  <div id="title">
    <h1>Inscription</h1>
  </div>
  <form method="POST">
  <?php echo $authmsg; ?>
    <div>
      <input name="mail_user" placeholder="Mail" required>
    </div>
    <div>
      <input type="password" name="pwd_user" placeholder="Mot de passe" required>
    </div>
    <div>
      <input name="nom_user" placeholder="Nom" required>
      <input name="prenom_user" placeholder="Prénom" required>
    </div>
    <div>
      <input name="tel_user" placeholder="Téléphone" required>
    </div>
    <div>
      <input name="adresse_user" placeholder="Adresse" required>
      <input name="cp_user" placeholder="Code postal" required>
      <input name="ville_user" placeholder="Ville" required>
    </div>
    <div>
    <input name="description_user" placeholder="Description" required>
    </div>
      <button type="submit" value="Login">Login</button>
      <a href='index.php'>Retour</a>
    </div>
    <br>
  </form>
</body>
</html>
