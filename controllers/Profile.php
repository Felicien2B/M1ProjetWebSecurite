<?php 
session_start();
class Profile extends Controller
{
    public function index()
    {
        //grab the user profile info 
        $this->loadModel("MyProfile");
        $user = $this->MyProfile->getProfile($_SESSION["username"]);
        //here we will redirect to the profile page of the authenticated user 
        $this->render("index",['user' => $user]);
    }

    public function complete()
    {
        //this function renders the page to complete profile data 
        $this->render("complete");
    }

    public function handleComplete()
    {
        if((isset($_POST["firstname"]) & !empty(trim($_POST["firstname"]))) & (isset($_POST["lastname"]) & !empty(trim($_POST["lastname"]))) & (isset($_POST["telephone"]) & !empty(trim($_POST["telephone"]))) & (isset($_POST["city"]) & !empty(trim($_POST["city"]))) )
        {
            //validate the incoming data
            $firstname = htmlspecialchars($_POST["firstname"]);
            $lastname = htmlspecialchars($_POST["lastname"]);
            $telephone = htmlspecialchars($_POST["telephone"]);
            $city     = htmlspecialchars($_POST["city"]);
            $email = $_SESSION["username"];
            //call the model interacting with db 
            $this->loadModel("MyProfile");
            $result = $this->MyProfile->addToProfile($email,$firstname,$lastname,$telephone,$city);
            if($result)
            {
                $_SESSION["message"] = "Profile edited succesefuly";
                header("Location: /profile");
                $_SESSION["firstname"] = $firstname;
                $_SESSION["lastname"]  = $lastname;
            }
            else
            {
                $_SESSION["error"] = "Oops, there was trouble while trying to update your profile";
                header("Location: /profile/complete");
            }
            
        }
        else
        {
            $_SESSION["error"] = "please enter all fields !";
            header("Location: /profile/complete");
        }
      
    
    }
    public function addProfilePicture()
    {
        if( isset($_FILES["profile"]) & strlen($_FILES["profile"]["name"])>0  )
        {
            $filename = $_FILES["profile"]["name"];
            $filesize = $_FILES["profile"]["size"];
            $filetype = $_FILES["profile"]["type"];
            $tempname = $_FILES["profile"]["tmp_name"];
            $error    = $_FILES["profile"]["error"];
            if($error ===0)
            {
                if($filesize > 200000)
                {
                    $_SESSION["error"] = "image too large limited size 200KB";
                    header("Location: /profile/index");
                }
                else 
                {
                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $extension_lc = strtolower($file_extension);
                    $allowed_extensions =array("jpg","jpeg", "png");
                    if(in_array($extension_lc, $allowed_extensions))
                    {
                        $new_file_name = uniqid("PROFILE-",true).".".$extension_lc;
                        $profile_path_upload = "./profile/".$new_file_name ;
                        move_uploaded_file($tempname, $profile_path_upload);
                        //store url to profile in db
                        $this->loadModel("Mypicture");
                        $result = $this->Mypicture->addPicture($_SESSION["username"], $new_file_name);
                        if($result)
                        {
                            //pic added to db with success
                            $_SESSION["message"] = "profile picture added with success !";
                            $_SESSION["url_profile"] = $new_file_name;
                            header("Location: /profile/index");
                        }
                        else 
                        {
                            $_SESSION["error"] = "Oops, there was a trouble adding the picture to db";
                            header("Location: /profile/index");
                        }

                    }
                    else
                    {
                        $_SESSION["error"]="submitted extension is not allowed, only jpg, jpeg and png";
                        header("Location: /profile/index");
                    }
                }
            }
        }
        else
        {
            $_SESSION["error"] = "No file inserted, please insert image";
            header("Location: /profile/index");
        }
    }

    public function changeProfilePicture()
    {
        if( isset($_FILES["profile"]) & strlen($_FILES["profile"]["name"])>0  )
        {
            $filename = $_FILES["profile"]["name"];
            $filesize = $_FILES["profile"]["size"];
            $filetype = $_FILES["profile"]["type"];
            $tempname = $_FILES["profile"]["tmp_name"];
            $error    = $_FILES["profile"]["error"];
            if($error ===0)
            {
                if($filesize > 200000)
                {
                    $_SESSION["error"] = "image too large limited size 200KB";
                    header("Location: /profile/index");
                }
                else 
                {
                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $extension_lc = strtolower($file_extension);
                    $allowed_extensions =array("jpg","jpeg", "png");
                    if(in_array($extension_lc, $allowed_extensions))
                    {
                        $new_file_name = uniqid("PROFILE-",true).".".$extension_lc;
                        $profile_path_upload = "./profile/".$new_file_name ;
                        move_uploaded_file($tempname, $profile_path_upload);
                        //store url to profile in db
                        $this->loadModel("Mypicture");
                        $result = $this->Mypicture->modifyPicture($_SESSION["username"], $new_file_name);
                        if($result)
                        {
                            //pic added to db with success
                            $_SESSION["message"] = "profile picture updated with success !";
                            header("Location: /profile/index");
                            $_SESSION["url_profile"] = $new_file_name;
                        }
                        else 
                        {
                            $_SESSION["error"] = "Oops, there was a trouble updating your profile picture";
                            header("Location: /profile/index");
                        }

                    }
                    else
                    {
                        $_SESSION["error"]="submitted extension is not allowed, only jpg, jpeg and png";
                        header("Location: /profile/index");
                    }
                }
            }
        }
        else
        {
            $_SESSION["error"] = "No file inserted, please insert image";
            header("Location: /profile/index");
        }



    }
}
?>