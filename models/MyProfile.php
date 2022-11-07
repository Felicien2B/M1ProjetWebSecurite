<?php 
class MyProfile extends Model{
    public function __construct()
    {
        $this->table="profiles";
        $this->getConnexion();
    }
    //retreive a user by it's login/email
    public function getProfile(string $login)
    {
        $sql = "SELECT first_name, last_name, telephone, city FROM ".$this->table." WHERE email=:email";
        $query = $this->connexion->prepare($sql);
        $query->execute(['email' => $login]);
        return $query->fetch();
    }

    public function addToProfile(string $email, string $firstname,string $lastname, string $telephone, string $city)
    {
        $sql = "INSERT INTO ".$this->table." (email, first_name, last_name, telephone, city, active) VALUES (:email, :firstname, :lastname, :telephone, :city, :active)";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            'email'    => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'telephone' => $telephone,
            'city' => $city,
            'active' => false,
        ]);
        return $result;

    }

}