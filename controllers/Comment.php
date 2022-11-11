<?php 
session_start();
class Comment extends Controller
{
    public function add(int $postId)
    {
        //validate the incoming data 
        if( isset($_POST["comment"]) & strlen(trim($_POST["comment"]))>0 )
        {
            //this function handles adding a comment to a specific post
            $mycomment = htmlspecialchars($_POST["comment"]);
            $this->loadModel("MyComment");
            $result = $this->MyComment->addComment($_SESSION["username"], $postId, $mycomment);
            if($result)
            {
                $_SESSION["message"] = "comment added with success";
                header("Location: /home");
            }
            else
            {
                $_SESSION["error"] = "failed to add comment";
                header("Location: /home");
            }
        }
        else 
        {
            $_SESSION["error"] = "please enter a valid comment, empty strings are not allowed !";
            header("Location: /home");
        }
         
    }
}
?>