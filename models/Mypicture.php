<?php 
class Mypicture extends Model{
    public function __construct()
    {
        $this->table="pictures";
        $this->getConnexion();
    }
    public function addPicture(string $email, string $path)
    {
        $sql = "INSERT INTO ".$this->table." (email, profile_pic) VALUES (:email, :profile_pic)";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            "email" => $email,
            "profile_pic" => $path,
        ]);
        return $result ;

    }

    public function getProfilePicture(string $login)
    {
        $sql = "SELECT profile_pic FROM ".$this->table." WHERE email = :email";
        $query = $this->connexion->prepare($sql);
        $query->execute([
            "email" => $_SESSION["username"],
        ]);
        return $query->fetch();
    }

    public function modifyPicture(string $login, string $path)
    {
        $sql = "UPDATE ".$this->table." SET profile_pic = :profile WHERE email = :email";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            "profile" => $path,
            "email"   => $login,
        ]);
        return $result;
    }


}
?>  