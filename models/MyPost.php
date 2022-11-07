<?php 
class MyPost extends Model{
    public function __construct()
    {
        $this->table="posts";
        $this->getConnexion();
    }

    public function insertPost(int $userid, string $post_text=" ", string $imgname=" ")
    {
        $sql = "INSERT INTO ".$this->table." (user_id, post_text, post_img, created_at) VALUES (:user_id, :post_text, :post_img, :created_at)";
        $query = $this->connexion->prepare($sql);
        $result = $query->execute([
            "user_id" => $userid,
            "post_text" => $post_text,
            "post_img"  => $imgname,
            "created_at" => date('Y-m-d H:i:s'),
        ]);
        return $result;
    }

    public function getPosts()
    {
        $sql = "SELECT posts.id, posts.post_text, posts.post_img, posts.created_at, profiles.first_name, profiles.last_name, profiles.email, pictures.profile_pic FROM ".$this->table." JOIN users ON posts.user_id = users.id JOIN profiles ON profiles.email = users.email  LEFT OUTER JOIN pictures ON users.email=pictures.email ORDER BY posts.created_at DESC";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}

?>