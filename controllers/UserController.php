<?php

require '../models/UserModel.php';  // Verander dit naar het juiste pad

if (isset($_POST['register'])) {
    // Haal formuliergegevens op
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);  // Wachtwoord versleutelen

    // Gebruik het UserModel om de gebruiker op te slaan
    $userCreated = UserModel::create([
        'naam' => $naam,
        'achternaam' => $achternaam,
        'email' => $email,
        'gebruikersnaam' => $gebruikersnaam,
        'wachtwoord' => $wachtwoord,
    ]);

    if ($userCreated) {
        // Redirect naar loginpagina als registratie succesvol is
        header('Location: ../views/login.php');
        exit;
    } else {
        echo "Registratie mislukt. Probeer het opnieuw.";
    }
}
