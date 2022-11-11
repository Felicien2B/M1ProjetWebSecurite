<?php 
session_start();
class Home extends Controller
{
    public function index()
    {
        if(!isset($_SESSION["firstname"]) & !isset($_SESSION["lastname"]) )
        {
            header("Location: /profile/index");
        }
        else
        {
            //grab all the posts by order DESC of creation date and pass them to view to display
            $this->loadModel("MyPost");
            $posts = $this->MyPost->getPosts();
            if($posts)
            {
                //grab the comments associated with each post 
                $this->loadModel("MyComment");
                $comments = $this->MyComment->getComments();
                if($comments)
                {
                    $this->render("index",["posts" => $posts,"comments"=>$comments]);
                }
                else
                {
                    $_SESSION["error"] = "there was trouble with loading comments associated with posts";
                    header("Location: /home");
                }
            }
            else
            {
                $_SESSION["error"] = "there was trouble with loading posts";
                header("Location: /home");
            }

        }

        

         
    }
}
?>