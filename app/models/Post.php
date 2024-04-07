<?php

namespace app\models;
require_once "../app/core/Database.php";

use app\core\Database;

use PDO;
use PDOException;
class Post
{
    use Database;
    public function getAllPosts()
    {
        $connection = $this->connect();
    
        $statement = $connection->prepare("SELECT * FROM posts");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }   

    public function saveAPost($title, $description)
    {
        $connection = $this->connect();

        $statement = $connection->prepare("INSERT INTO posts (title, description) VALUES (:title, :description)");
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        return $statement->execute();
    }
    public function updateAPost($id, $title, $description)
    {
        $connection = $this->connect();

        $statement = $connection->prepare("UPDATE posts SET title = :title, description = :description WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        return $statement->execute();
    }
    public function getPostByAnId($id)
    {
        $connection = $this->connect();

        $statement = $connection->prepare("SELECT * FROM posts WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAPost($id)
    {
        $connection = $this->connect();

        $statement = $connection->prepare("DELETE FROM posts WHERE id = :id");
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}