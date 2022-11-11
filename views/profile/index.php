<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>My Profile</title>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img class="logo" src="/assets/zozor.png" alt="logo">
            <ul>
                <li>
                    <img src="/assets/notification.png" alt="">
                </li>
                <li>
                    <img src="/assets/inbox.png" alt="">
                </li>
                <li>
                    <a href="/home">
                    <img src="/assets/video.png" alt="home">
                    </a>
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
                <a href="/auth/logout">Logout</a>
            </button>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="/assets/search.png" alt="search">
                <input type="text" placeholder="search">
            </div>
            <div class="nav-user-icon online">
                <a href="/profile/index">
                    <?php if(isset($_SESSION["url_profile"])) { ?>
                    <img  src="/profile/<?=$_SESSION["url_profile"]?>" alt="image-profil">
                    <?php } else { ?>
                     <img src="/assets/profile.jpg">
                    <?php } ?>
                </a>
            </div>
        </div>
    </nav>
    <div class="profile-section">
        <div class="head-profile">
            <h2>My Profile</h2>
            <p class="error-message">
                <?php if(isset($_SESSION["error"])){
                    echo $_SESSION["error"];
                }?>
                <?php if(isset($_SESSION["message"])){
                    echo $_SESSION["message"];
                }?>
            </p>
            <div class="profile-data">
                <?php if(!isset($user["first_name"]) && !isset($user["last_name"]) &&!isset($user["telephone"]) && !isset($user["city"]))
                {?>
                <div class="empty-profile">
                    <p>after completing your profile you can navigate to home
                        which corresponds to the first icon left the logout button</p>
                    <p>While your profile is incomplete you will be redirected here</p>
                    <p>the profile picture is not necessary</p>
                    <p>Your Profile is empty, you can complete it Here</p>
                    <button>
                        <a href="/profile/complete">Complete My Profile</a>
                    </button>
                </div>
                <?php } else { ?>
                    <div class="full-profile">
                    <div class="firstname">Your Name :<strong><?=$user["first_name"]?></strong></div>
                    <div class="lastname">Your lastName :<strong><?=$user["last_name"]?></strong></div>
                    <div class="telephone">Your Phone Number :<strong><?=$user["telephone"]?></strong></div>
                    <div class="city">Your actuel City :<strong><?=$user["city"]?></strong></div>
                    <?php if(!isset($_SESSION["url_profile"])) {?>
                    <button id="toggle" onClick="hideform()">Add profile picture</button>
                    <div class="add-profile-pic">
                        <form method="POST" action="/profile/addProfilePicture" enctype="multipart/form-data">
                            <label for="profile">Insert your Image :</label>
                            <input type="file" name="profile" id="profile">
                            <button type="submit">Ajouter</button>
                        </form>
                    </div>
                    <?php } else { ?>
                    <button id="toggle2" onClick="hideform2()">Modify profile picture</button>
                    <div class="modify-profile-pic">
                        <form method="POST" action="/profile/changeProfilePicture" enctype="multipart/form-data">
                            <label for="profile">Select a new Image :</label>
                            <input type="file" name="profile" id="profile">
                            <button type="submit">Ajouter</button>
                        </form>
                    </div>
                    <?php } ?>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php $_SESSION["message"] = ""?>
<?php $_SESSION["error"] = ""?>
<script src="/script.js"></script>
</body>
</html>