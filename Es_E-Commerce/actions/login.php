<?php

// Inclusione dei file necessari
require_once "../viste/database.php";
require_once "../models/user.php";
require_once "../models/session.php";

// Recupera l'email e la password dalla richiesta POST
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);

// Crea un'istanza del database
$database = new \Database("192.168.10.177", "3306", "root", "");
$pdo = $database->connect("ecommerce5E");

// Prepara e esegui la query per cercare un utente corrispondente all'email e alla password fornite
$stm = $pdo->prepare("SELECT * FROM ecommerce5E.users WHERE email=:email AND password=:password LIMIT 1");
$stm->bindParam(":email", $email);
$stm->bindParam(":password", $password);
$stm->execute();

// Recupera l'utente corrente
$current_user = $stm->fetchObject("\models\User");

// Se l'utente esiste
if ($current_user) {
    // Inizia la sessione
    session_start();

    // Crea un array di parametri per la sessione
    $params = array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $current_user->getId());

    // Crea una nuova sessione nel database
    \models\Session::create($params);

    // Salva l'utente corrente nella sessione
    $_SESSION['current_user'] = $current_user;

    // Reindirizza alla pagina principale dei prodotti
    header('Location: http://localhost:8000/viste/home.hmtl');
    exit;
} else {
    // Se l'utente non esiste, reindirizza alla pagina di login
    header('Location: http://localhost:8000/viste/login.hmtl');
    exit;
}
