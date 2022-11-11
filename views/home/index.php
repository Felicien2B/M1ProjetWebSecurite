<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>SocialBook</title>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img class="logo" src="assets/zozor.png" alt="logo">
            <ul>
                <li>
                    <img src="assets/notification.png" alt="notification">
                </li>
                <li>
                    <img src="assets/inbox.png" alt="inbox">
                </li>
                <li>
                    <a href="/home"><img src="assets/video.png" alt="video"></a>
                </li>
            </ul>
        </div>
        <div class="nav-middle">
            <?php if( isset($_SESSION["firstname"]) & isset($_SESSION["lastname"]) )
                { 
                $fullUserName = $_SESSION["firstname"]." ".$_SESSION["lastname"];}
                 else 
                {
                    $fullUserName = $_SESSION["username"];
                }?>
            <p>
            <strong>Hello <?=$fullUserName?></strong></p>
            <button>
                <a href="/auth/logout">Logout</a>
            </button>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="assets/search.png" alt="search">
                <input type="text" placeholder="search">
            </div>
            <div class="nav-user-icon online">
                <a href="/profile/index">
                    <?php if(isset($_SESSION["url_profile"])) { ?>
                    <img src="/profile/<?=$_SESSION["url_profile"]?>">
                    <?php } else { ?>
                    <img src="assets/profile.jpg">
                    <?php } ?>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <!---  left-sidebar----->
        <div class="left-sidebar">
            <div class="important-links">
                <a href="">
                    <img src="assets/news.png" alt="">
                    Latest News
                </a>
                <a href="">
                    <img src="assets/friends.png" alt="">
                    Freinds
                </a>
                <a href="">
                    <img src="assets/group.png" alt="">
                    Group
                </a>
                <a href="">
                    <img src="assets/marketplace.png" alt="">
                    Market Place
                </a>
                <a href="">
                    <img src="assets/watch.png" alt="">
                    watch
                </a>
                <a href="">
                    See More
                </a>
            </div>
        </div>
        <!---  main-content----->
        <div class="main-content">
            <div class="story-galery">
                <div class="story">
                    <img src="/assets/upload.png">
                    <?php isset($fullUserName)? $name=$fullUserName : $name=""?>
                    <p><?=$name?></p>
                </div>
            </div>
            <div class="write-post">
                <div class="user-profile">
                    <?php if(isset($_SESSION["url_profile"])) { ?>
                    <img src="/profile/<?=$_SESSION["url_profile"]?>">
                    <?php } else { ?>
                    <img src="/assets/profile.jpg">
                    <?php } ?>
                    <div>
                        <p> <?php isset($fullUserName)? $name=$fullUserName : $name=$_SESSION["username"] ?>
                            <?=$name?>
                        </p>
                        <small>public</small>
                    </div>
                </div>
                <div class="post-input">
                <form method="POST" action="/post/addnew" enctype="multipart/form-data">
                    <?php if(isset($_SESSION["firstname"])) { ?>
                    <textarea name="post" rows="5" placeholder="what's on your Mind, <?=$_SESSION["firstname"]?>?"></textarea>
                    <?php } else { ?>
                    <textarea name="post" rows="5" placeholder="what's on your Mind, <?=$_SESSION["username"]?>?"></textarea>
                    <?php } ?>
                    <input type="file" name="uploadfile">
                    <div class="add-post-links">
                        <a href="">
                            <img src="/assets/live-video.png">Live/vidéo
                        </a>
                        <a href="">
                            <img src="/assets/photo.png">Photo
                        </a>
                        <a href="">
                            <img src="/assets/feeling.png">feeling/activity
                        </a>
                        <button type="submit" name="submitpost">Add Post</button>
                    </div>
                </form>
                </div>
            </div>

            
            <div class="posts-container">
            <?php foreach($posts as $post) {  ?>
                <div class="user-profile">
                    <?php if(isset($post["profile_pic"])) { ?>
                    <img src="/profile/<?=$post["profile_pic"]?>">
                    <?php } else { ?>
                    <img src="/assets/profile.jpg">
                    <?php } ?>
                    <div>
                        <p> <?php $fullUserName = $post["first_name"]." ".$post["last_name"];
                        (isset($fullUserName) & strlen(trim($fullUserName))>0 )? $name=$fullUserName: $name=$post["email"] ?>
                            <?=$name?>
                        </p>
                        <span><?=$post["created_at"]?></span>
                    </div>
                </div>
                <p class="post-text"><?=$post["post_text"]?></p>
                <?php if(isset($post["post_img"]) & strlen($post["post_img"])>1) { ?>
                    <img src="/storage/<?=$post["post_img"]?>" class="post-img">
                <?php } ?>
                <div class="post-comments">
                    <?php if(isset($_SESSION["url_profile"])) { ?>
                    <img src="/profile/<?=$_SESSION["url_profile"]?>">
                    <?php } else { ?>
                    <img src="/assets/profile.jpg">
                    <?php } ?>
                    <div>
                    <form method="POST" action="/comment/add/<?=$post["id"]?>">
                    <input type="text" name="comment" id="comment" placeholder="type your comment here" autocomplete="off">
                    <button type="submit">add comment</button>
                    </form>
                    <div class="comments-section">
                        <?php foreach($comments as $comment) { 
                            if($comment["post_id"] === $post["id"]){
                            ?>
                            <div class="individual-comment">
                            <strong><?= $comment["first_name"]." ".$comment["last_name"] ?></strong> :  <?= $comment["content"] ?>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            

        </div>
        <!---  right-sidebar----->
        <div class="right-sidebar">
            <div class="sidebar-right-title">
                <h4>Events</h4>
                <a href="">See All</a>
            </div>
            <div class="event">
                <div class="left-event">
                    <h3>18</h3>
                    <span>march</span>
                </div>
                <div class="right-event">
                    <h4>Social Media</h4>
                    <a href="">More Info</a>
                </div>
            </div>
            <div class="sidebar-right-title">
                <h4>advertisement</h4>
                <a href="">Close</a>
            </div>
            <img src="assets/advertisement.png" class="sidebar-ads">

            <div class="sidebar-right-title">
                <h4>Conversation</h4>
                <a href="">Hide Chat</a>
            </div>
            <div class="online-friends">
                
            </div>
        </div>
    </div>

    
</body>
</html>