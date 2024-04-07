<?php

namespace app\models;

use PDO;
use PDOException;
trait Database
{
    private function connect()
    {
        $type = 'mysql';
        $server = 'localhost';
        $db = 'homework_9';
        $port = '8888';
        $charset = 'utf8mb4';

        //the mamp default values here
        $username = '';
        $password = '';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //set the default fetch type
            //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,/
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

        try {
            return new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
}

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