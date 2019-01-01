<?php

class User  
{
    private $pdo;
    public function __construct($database){
        $this->pdo = $database;
    }
    public function login($login,$password){
        $sql = "select * from users where login like ? and pass like ? limit 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login, md5($password)]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function save($login,$name,$last_name,$password){
        $sql = "INSERT INTO `users`(`login`, `nom`, `prenom`, `pass`) 
        VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute([$login,$name,$last_name,md5($password)]);
            return $this->login($login,$password);
        } catch (\Exception $th) {
            throw $th;
        }       
        
    }

    public function getAll($page=1){
        $sql = "select * from users where login <> ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['admin']);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}
