<?php

namespace models;

require_once "../viste/database.php";

class user
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    private $email;
    private $password;
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public static function findByEmail($email)
    {
        // Creazione di un'istanza del database
        $database = new \Database("192.168.1.5", "3306", "cristiano", "password");
        $pdo = $database->connect("ecommerce5E");

        // Prepara e esegui la query per cercare l'utente per email
        $stm = $pdo->prepare("SELECT * FROM ecommerce5E.users WHERE email=:email LIMIT 1");
        $stm->bindParam(":email", $email);
        $stm->execute();

        return $stm->fetchObject("\models\User");
    }

    public function save($pdo)
    {
        // Prepara e esegui la query per inserire un nuovo utente nel database
        $stm = $pdo->prepare("INSERT INTO ecommerce5E.users(email, password) VALUES (:email, :password)");
        $stm->bindParam(":email", $this->getEmail());
        $stm->bindParam(":password", $this->getPassword());
        $stm->execute();
    }
}

