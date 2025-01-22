<?php

require_once '../models/UserModel.php';  // Zorg ervoor dat het juiste pad naar je model wordt gebruikt

if (isset($_POST['register'])) {
    // Haal formuliergegevens op
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);  // Wachtwoord versleutelen

    // Gebruik het UserModel om de gebruiker op te slaan
    $userCreated = UserModel::save([
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
        // Als er iets mis is met de registratie
        echo "Registratie mislukt. Probeer het opnieuw.";
    }
}

// Optioneel: Voorbeeld om een gebruiker op te halen via ID
if (isset($_GET['user_id'])) {
    $user = UserModel::getID($_GET['user_id']);
    if ($user) {
        echo "Gebruiker: " . $user['naam'];
    } else {
        echo "Gebruiker niet gevonden.";
    }
}

// Optioneel: Voorbeeld om alle gebruikers op te halen
$users = UserModel::findAll();
foreach ($users as $user) {
    echo $user['naam'] . "<br>";
}
?>
