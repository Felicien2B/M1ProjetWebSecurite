<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Register</title>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img class="logo" src="/assets/zozor.png" alt="logo">
            <h4>Social Network</h4>
        </div>
    </nav>
    <div class="container">
        <form class="register-form" method="POST" action="/auth/handleRegister">
            <p><strong>You can Register Here</strong></p>
            <?php 
            if(isset($_SESSION["error"]))
            {
                echo $_SESSION["error"];
            }?>
            <label for="email">Email Adress :</label>
            <input type="email" id="email" name="email" autocomplete="off">
            <label for="password">Choose a Password:</label>
            <input type="password" id="password" name="password">
            <label for="confirm">Confirm your password:</label>
            <input type="password" id="confirm" name="confirm">
            <button type="submit">Register</button>
        </form>
    </div>
<?php 
$_SESSION["error"] = ""
?>
</body>
</html>