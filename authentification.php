<?php
session_start();

require "config/database.php";

$authmsg="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$mail_user=$_POST["mail_user"];
	$password=$_POST["pwd_user"];


	$sql="SELECT * FROM user WHERE mail_user='$mail_user' AND pwd_user='$password'";

	$result=$bdd->query($sql);

	$row=$result->fetch(PDO::FETCH_ASSOC);

	if(!empty($row["id_user"]))
	{
		$_SESSION["mail_user"]=$mail_user;

		header("location:index.php");
	}

	else
	{
		$authmsg = "<div class='error' style='text-align: center'>Mauvais identifiant ou mot de passe.</div>";
	}
}
?>


<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet"/>
</head>
<body>
  <div id="title">
    <h1>Authentification</h1>
  </div>
  <form method="POST">
    <?php echo $authmsg; ?>
    <div>
      <input name="mail_user" placeholder="Mail" required>
    </div>
    <div>
      <input type="password" name="pwd_user" placeholder="Mot de passe" required>
    </div>
      <button type="submit" value="Login">Login</button>
      <a href="inscription.php">Créer un nouveau compte</a>
    </div>
    <br>
  </form>
</body>
</html>
