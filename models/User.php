<?php 
class User extends Model{
    public function __construct()
    {
        $this->table="users";
        $this->getConnexion();
    }
    //retreive a user by it's login/email
    public function getUserByMail(string $login)
    {
        $sql = "SELECT id, motdepasse FROM ".$this->table." WHERE email=:email";
        $query = $this->connexion->prepare($sql);
        $query->execute(['email' => $login]);
        return $query->fetch();
    }

    public function addUser(string $email,string $password, string $confirm)
    {
        $sql = "INSERT INTO ".$this->table." (email, motdepasse, confirm, created_at) VALUES (:email, :motdepasse, :confirm, :created_at)";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            'email' => $email,
            'motdepasse' => $password,
            'confirm' => $confirm,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $result;

    }

}