<?php 
session_start();
class Post extends Controller
{
    public function addnew()
    {
        $userid = $_SESSION["userid"];
        echo "here we will handle the post submission form";
        if( isset($_POST["post"]) & !empty($_POST["post"]) ) 
        {
            $text = htmlspecialchars($_POST["post"]);
            if( isset($_FILES["uploadfile"]) & !empty($_FILES["uploadfile"]) & (strlen($_FILES["uploadfile"]["name"])>0)) 
            {
        
                $filename = $_FILES["uploadfile"]["name"];
                $filetype = $_FILES["uploadfile"]["type"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $filesize = $_FILES["uploadfile"]["size"];
                $error    = $_FILES["uploadfile"]["error"];
                if($error === 0)
                {
                    if($filesize > 200000)
                    {
                        $_SESSION["error"] = "sorry your file is too large";
                        header("Location: http://localhost/mini-facebook/home ");
                    }
                    else
                    {
                        $file_extension = pathinfo($filename,PATHINFO_EXTENSION);
                        $extension_lc = strtolower($file_extension);
                        $allowed_extensions = array("jpg", "jpeg", "png");
                        if(in_array($extension_lc, $allowed_extensions))
                        {
                            $new_file_name = uniqid("IMG-",true).".".$extension_lc;
                            $file_upload_path = "./storage/".$new_file_name;
                            move_uploaded_file($tempname, $file_upload_path);
                            //load the model interacting with database to store the post data
                            $this->loadModel("MyPost");
                            $result = $this->MyPost->insertPost($userid, $text, $new_file_name);
                            if($result)
                            {
                                $_SESSION["message"] = "post added succesefuly !";
                                header("Location: http://localhost/mini-facebook/home");
                            }
                            else 
                            {
                                $_SESSION["error"] = "image saved to storage file but failded to store to db";
                                header("Location: http://localhost/mini-facebook/home");
                            }
                        }
                        else
                        {
                            $_SESSION["error"] ="you can't load files with that format";
                            header("Location: http://localhost/mini-facebook/home");
                        }

                    }

                }
                else
                {
                    //redirect back with error message 
                    $_SESSION["error"] ="Oops, sorry something went wrong !";
                    header("Location: http://localhost/mini-facebook/home");
                }
        

            }
            else
            {
                //only a post is submitted with no image 
                $this->loadModel("MyPost");
                $result = $this->MyPost->insertPost($userid, $text);
                if($result)
                {
                    $_SESSION["message"] = "post added succesefuly !";
                    header("Location: http://localhost/mini-facebook/home");
                }
                else
                {
                    $_SESSION["error"] = "something went wrong !";
                    header("Location: http://localhost/mini-facebook/home");

                }


            }
        }
        else
        {
            //there is no post text, verify if there's an image 
            
            if( isset($_FILES["uploadfile"]) & !empty($_FILES["uploadfile"]) & (strlen($_FILES["uploadfile"]["name"])>0)) 
            {
        
                $filename = $_FILES["uploadfile"]["name"];
                $filetype = $_FILES["uploadfile"]["type"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $filesize = $_FILES["uploadfile"]["size"];
                $error    = $_FILES["uploadfile"]["error"];
                if($error === 0)
                {
                    if($filesize > 200000)
                    {
                        $_SESSION["error"] = "sorry your file is too large";
                        header("Location: http://localhost/mini-facebook/home ");
                    }
                    else
                    {
                        $file_extension = pathinfo($filename,PATHINFO_EXTENSION);
                        $extension_lc = strtolower($file_extension);
                        $allowed_extensions = array("jpg", "jpeg", "png");
                        if(in_array($extension_lc, $allowed_extensions))
                        {
                            $new_file_name = uniqid("IMG-",true).".".$extension_lc;
                            $file_upload_path = "./storage/".$new_file_name;
                            move_uploaded_file($tempname, $file_upload_path);
                            //load the model interacting with database to store the post data
                            $this->loadModel("MyPost");
                            $result = $this->MyPost->insertPost($userid, $text="", $new_file_name);
                            if($result)
                            {
                                $_SESSION["message"] = "post added succesefuly !";
                                header("Location: http://localhost/mini-facebook/home");
                            }
                            else 
                            {
                                $_SESSION["error"] = "image saved to storage file but failded to store to db";
                                header("Location: http://localhost/mini-facebook/home");
                            }
                        }
                        else
                        {
                            $_SESSION["error"] ="you can't load files with that format";
                            header("Location: http://localhost/mini-facebook/home");
                        }

                    }

                }
                else
                {
                    //redirect back with error message 
                    $_SESSION["error"] ="Oops, sorry something went wrong !";
                    header("Location: http://localhost/mini-facebook/home");
                }
        

            }
            else
            {
                $_SESSION["error"] ="empty fields are not allowed, one at least is required!";
                header("Location: http://localhost/mini-facebook/home");

            }
        }
    }
}
?>