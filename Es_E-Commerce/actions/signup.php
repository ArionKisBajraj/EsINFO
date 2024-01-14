<?php


// Inclusione dei file necessari
require_once "../viste/database.php";
require_once "../models/user.php";

// Verifica se la richiesta è di tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera l'email e la password dal form HTML (supponendo che siano presenti campi 'email' e 'password')
    $email = $_POST["email"];
    $password = hash('sha256', $_POST["password"]);

    // Creazione di un'istanza del database
    $database = new Database("192.168.1.5", "3306", "cristiano", "password");
    $pdo = $database->connect("ecommerce5E");

    // Controlla se l'email è già registrata
    $existingUser = models\User::findByEmail($email);

    if (!$existingUser) {
        // Se l'email non è già registrata, crea un nuovo utente
        $newUser = new models\User();
        $newUser->setEmail($email);
        $newUser->setPassword($password);

        // Salva l'utente nel database
        $newUser->save($pdo);

        // Reindirizza alla pagina di login dopo l'iscrizione
        header('Location: http://localhost:8000/views/login.html');
    } else {
        // Gestisce il caso in cui l'email è già registrata
        // Puoi visualizzare un messaggio di errore o reindirizzare nuovamente alla pagina di registrazione
        header('Location: http://localhost:8000/viste/signup.hmtl?error=email_exists');
    }
    exit;
}





