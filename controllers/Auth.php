<?php 
session_start();
class Auth extends Controller
{
    public function index()
    {
        $this->render("index");
    }

    public function register()
    {
        $this->render('register');
    }

    public function handleRegister()
    {
        //function handling registring a new user
        if(!isset($_POST["email"]) | !isset($_POST["password"]) | !isset($_POST["confirm"]))
        {
            //if missing data redirect to the form page with error message
            $_SESSION["error"]="all fields are required !";
            header("Location:  http://localhost/mini-facebook/auth/register");
        }
        else
        {
            //validate the incoming data
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            $passwordConfirmation = htmlspecialchars($_POST["confirm"]);

            //verify if the password and the confirmation password are identique
            if($password == $passwordConfirmation)
            {
                //hash the password using bcrypt
                $hashedPwd = password_hash($password,PASSWORD_DEFAULT);
                //load the model class interacting with users table
                $this->loadModel("User");
                //load the profile model interacting with profiles table
                $affectedRows = $this->User->addUser($email, $hashedPwd, $hashedPwd);
                if($affectedRows)
                {
                    //the insertion was succesefull
                    $_SESSION["username"] = $email;
                    $_SESSION["message"] = "registred succesefuly type in your credentials to login";
                    //redirect to home page
                    header("Location: http://localhost/mini-facebook/auth/index");
                }
                else
                {
                    $_SESSION["error"] = "Oops, there was something wrong with request !";
                    header("Location: http://localhost/mini-facebook/auth/register");
                }
            }
            else
            {
                $_SESSION["error"]="your confirmation password doesn't match the password !";
                header("Location: http://localhost/mini-facebook/auth/register");
            }
        }
    }

    public function login()
    {
        if(isset($_POST["email"]) & isset($_POST["password"]))
        {
            //protect the incoming data
            $login = htmlspecialchars($_POST["email"]);
            $password =htmlspecialchars($_POST["password"]);
            //instantiate the proper model that interacts with database users
            $this->loadModel("User");
            //call the apropriate method on the model 
            $user = $this->User->getUserByMail($login);
            if($user)
            {
                //the user exists in db
                //compare the passwored in db with the hashed input password 
                if(password_verify($password, $user["motdepasse"]))
                {
                    //the given credentials are correct
                    $_SESSION["username"] = $login;
                    $_SESSION["userid"]   = $user["id"];
                    //load the profile data for the autheticated user 
                    $this->loadModel("MyProfile");
                    $userProfile = $this->MyProfile->getProfile($login);
                    if($userProfile)
                    {
                        $_SESSION["firstname"] = $userProfile["first_name"];
                        $_SESSION["lastname"]  = $userProfile["last_name"];
                    }
                    //load the profile picture for the authenticated user 
                    $this->loadModel("Mypicture");
                    $profilePicture = $this->Mypicture->getProfilePicture($_SESSION["username"]);
                    if($profilePicture)
                    {
                        $_SESSION["url_profile"] = $profilePicture["profile_pic"];
                    }
                    //redirect the user to profile page to complete insription 
                    
                    header("Location: http://localhost/mini-facebook/profile/index");
                    
                }
                else
                {
                    $_SESSION["error"] = "the given credentials don't match our records, please verify your data";
                    //redirect back to the home page
                    header("Location: http://localhost/mini-facebook/auth/index");
                }
            }
            else
            {
                $_SESSION["error"] = "the given credentials don't match our records";
                //redirect back to the home page
                header("Location: http://localhost/mini-facebook/auth/index");
            }

        }
        else 
        {
            $_SESSION["error"] = "please enter all fields !";
            header("Location: http://localhost/mini-facebook/auth/index");
        }

    }

    public function logout()
    {
        
        //unset all session variables and redirect to the welcome page
        session_destroy();
        header("Location: http://localhost/mini-facebook/auth");
    }
}
?>