<?php

namespace models;
// Inclusione del file necessario
use Database;
use PDOException;
use RuntimeException;

require_once "../viste/database.php";



// Definizione della classe Session nel namespace models
class Session
{
    // Proprietà della classe
    private $id;
    private $ip;
    private $data_login;

    // Metodi getter e setter

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getDataLogin()
    {
        return $this->data_login;
    }

    public function setDataLogin($data_login)
    {
        $this->data_login = $data_login;
    }

    // Metodo statico per creare una nuova sessione nel database
    public static function create($params)
    {
        $date = date('Y-m-d H:i:s');

        // Creazione di un'istanza del database
        $database = new Database("192.168.10.177", "3306", "root", "");
        $pdo = $database->connect("ecommerce5E");

        // Prepara e esegui la query per inserire una nuova sessione nel database
        $stm = $pdo->prepare("INSERT INTO ecommerce5E.sessions(ip, data_login, user_id) VALUES (:ip, :data_login, :user_id)");
        $stm->bindParam(":ip", $params["ip"]);
        $stm->bindParam(":data_login", $date);
        $stm->bindParam(":user_id", $params["user_id"]);

        // Gestisce eventuali eccezioni durante l'esecuzione della query
        try {
            $stm->execute();
        } catch (PDOException $e) {
            throw new RuntimeException("Errore durante la creazione della sessione", 0, $e);
        }
    }
}