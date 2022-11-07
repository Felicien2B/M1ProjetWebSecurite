<?php 
abstract class Model{
    //information de connexion a la BDD
    private $dsn ="mysql:host=localhost;dbname=facebook;charset=utf8";
    private $username = "root";
    private $password = "";



    //la proprièté de connexion a la BDD
    protected $connexion;

    //informations de requetes
    public $table;
    public $id;

    public function getConnexion()
    {
        $this->connexion = null ;
        try
        {
            $this->connexion = new PDO($this->dsn, $this->username, $this->password);
        }
        catch(PDOException $e)
        {
            echo 'Erreur :'. $e->getMessage();
        }

    }

    //requets plus courantes pour avoir toutes les resoources ou une seule resoource
    public function getAll()
    {
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function get(int $id)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE id=:id";
        $query = $this->connexion->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
}




?>