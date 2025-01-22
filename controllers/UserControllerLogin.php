<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
session_start();  // Start de sessie
 
require_once '../models/UserModelLogin.php';  // Zorg ervoor dat je de juiste klasse importeert
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inloggen'])) {
    $data = [
        'gebruikersnaam' => $_POST['gebruikersnaam'],
        'wachtwoord' => $_POST['wachtwoord'],
    ];
 
    // Gebruik de loginmethode van UserModelLogin
    $user = UserModelLogin::login($data);
 
    if ($user) {
        // Login gelukt
        $_SESSION['user'] = $user; // Bewaar gebruikersgegevens in de sessie
        header('Location: ../views/dashboard.php'); // Stuur door naar een dashboard
        exit();
    } else {
        // Login mislukt
        header('Location: ../views/login.php?error=invalid_credentials');
        exit();
    }
}
?>
 