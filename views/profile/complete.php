<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mini-facebook/style.css">
    <title>Complete My Profile</title>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img class="logo" src="/mini-facebook/assets/zozor.png" alt="logo">
            <ul>
                <li>
                    <img src="/mini-facebook/assets/notification.png" alt="">
                </li>
                <li>
                    <img src="/mini-facebook/assets/inbox.png" alt="">
                </li>
                <li>
                    <a href="http://localhost/mini-facebook/home"><img src="/mini-facebook/assets/video.png" alt="video"></a>
                </li>
            </ul>
        </div>
        <div class="nav-middle">
            <?php if( isset($_SESSION["firstname"]) & isset($_SESSION["lastname"]) ){ 
                $fullUserName = $_SESSION["firstname"]." ".$_SESSION["lastname"];}?>
            <p>Hello 
            <strong>
                <?php isset($fullUserName)? $hello=$fullUserName : $hello=$_SESSION["username"]?>
                <?=$hello?>
            </strong></p>
            <button>
                <a href="http://localhost/mini-facebook/auth/logout">Logout</a>
            </button>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="/mini-facebook/assets/search.png" alt="search">
                <input type="text" placeholder="search">
            </div>
            <div class="nav-user-icon online">
                <a href="http://localhost/mini-facebook/profile"><img  src="/mini-facebook/assets/profile.jpg" alt="image-profil"></a>
            </div>
        </div>
    </nav>
    <div class="profile-section">
        <p class="error">
            <?php 
            if(isset($_SESSION["error"]))
            {
                echo $_SESSION["error"];
            }?>
        </p>
        <div class="complete-profile">
            <form method="POST" action="http://localhost/mini-facebook/profile/handleComplete">
                <label for="firstname">Your First Name</label>
                <input type="text" id="firstname" name="firstname">
                <label for="lastname">Your last Name</label>
                <input type="text" id="lastname" name="lastname">
                <label for="telephone">Your Phone Number</label>
                <input type="text" id="telephone" name="telephone">
                <label for="city">Your City</label>
                <input type="text" id="city" name="city">
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
    
</body>
</html>