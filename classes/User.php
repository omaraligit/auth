<?php

class User  
{
    private $pdo;
    public function __construct($database){
        $this->pdo = $database;
    }
    public function login($login,$password){
        $sql = "select `login`, `nom`, `prenom`, `created_at` from users where login like ? and pass like ? limit 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login, md5($password)]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function save($login,$name,$last_name,$password){
        $sql = "INSERT INTO `users`(`login`, `nom`, `prenom`, `pass`, `created_at`) 
        VALUES (?,?,?,?,now())";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute([$login,$name,$last_name,md5($password)]);
            return $this->login($login,$password);
        } catch (\Exception $th) {
            throw $th;
        }       
        
    }

    public function getPages(){
        $sql = "select count(*) as count from users where login <> ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['admin']);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count['count'];
    }

    public function delete($id){
        $sql = "DELETE FROM `users` WHERE id like ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getAll($page=1){
        $offset = ($page*10)-10;
        $limit  = 10;
        $sql = "select `id`, `login`, `nom`, `prenom`, `created_at` from users where login <> ? limit $limit OFFSET $offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['admin']);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function fillDB(){
        for ($i=0; $i < 40; $i++) { 
            $login     = "login_$i";
            $name      = "nom_$i";
            $last_name = "prenom_$i";
            $password  = 123;
            $sql = "INSERT INTO `users`(`login`, `nom`, `prenom`, `pass`, `created_at`) VALUES (?,?,?,?,now())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$login,$name,$last_name,md5($password)]);
        }
    }
}
