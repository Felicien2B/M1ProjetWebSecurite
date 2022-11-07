<?php 
class MyComment extends Model{
    public function __construct()
    {
        $this->table="comments";
        $this->getConnexion();
    }

    public function addComment(string $user_email, int $post_id, string $content)
    {
        $sql = "INSERT INTO ".$this->table." (user_email, post_id, content, created_at) VALUES (:email, :postid, :content, :created)";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            "email" => $_SESSION["username"],
            "postid" => $post_id,
            "content" => $content,
            "created" => date('Y-m-d H:i:s'),
        ]);
        return $result;

    }

    public function getComments()
    {
        $sql = "SELECT comments.user_email, comments.post_id, comments.content, comments.created_at, profiles.first_name, profiles.last_name FROM ".$this->table." INNER JOIN profiles ON comments.user_email = profiles.email ORDER BY created_at DESC";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

   

    
}

?>