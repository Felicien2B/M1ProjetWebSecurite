<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mini-facebook/style.css">
    <title>Authentication Page</title>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img class="logo" src="/mini-facebook/assets/zozor.png" alt="logo">
            <h4>Social Network</h4>
        </div>
        <div class="register-button">
            <p>You don't have an account !</p>
            <button>
                <a href="http://localhost/mini-facebook/auth/register">Register Here</a>
            </button>
        </div>
    </nav>
    <div class="container">
        <form class="auth-form" method="POST" action="http://localhost/mini-facebook/auth/login">
            <p class="error-display">
            <?php isset($_SESSION["message"]) ? $message = $_SESSION["message"] : $message="" ?>
            <?php if(isset($_SESSION["error"]))
            {
                echo $_SESSION["error"];
            }?>
            <?= $message ?>
            </p>
            <label for="email">Email Adress :</label>
            <input type="email" id="email" name="email" autocomplete="off">
            <label for="password">Password :</label>
            <input type="password" id="password" name="password">
            <button type="submit">Connexion </button>
        </form>
    </div>
<?php 
$_SESSION["error"] = "";
$_SESSION["message"] = "";
?>
</body>
</html>