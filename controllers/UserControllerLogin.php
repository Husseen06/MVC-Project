<?php
require_once '../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inloggen'])) {
    $data = [
        'gebruikersnaam' => $_POST['gebruikersnaam'],
        'wachtwoord' => $_POST['wachtwoord'],
    ];

    $user = UserModel::login($data);

    if ($user) {
        // Login gelukt
        session_start();
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
