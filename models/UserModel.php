<?php

class UserModel {
    public static function create($data) {
        try {
            // Connect to the database
            $dsn = "mysql:host=localhost;dbname=mvcproject";  // Update de database naam hier
            $conn = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            // Insert the data into the users table
            $stmt = $conn->prepare("INSERT INTO users (naam, achternaam, email, gebruikersnaam, wachtwoord)
                                    VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['naam'],
                $data['achternaam'],
                $data['email'],
                $data['gebruikersnaam'],
                $data['wachtwoord'],
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Voeg andere methoden en eigenschappen toe die je nodig hebt

    public static function login($data) {
        // Maak verbinding met de database
        $conn = new mysqli('localhost', 'root', '', 'mvcproject');

        // Controleer de verbinding
        if ($conn->connect_error) {
            die("Verbinding mislukt: " . $conn->connect_error);
        }

        // Bereid de SQL-instructie voor
        $stmt = $conn->prepare("SELECT * FROM users WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $data['gebruikersnaam']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Controleer het wachtwoord
            if (password_verify($data['wachtwoord'], $user['wachtwoord'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }

        // Sluit de verbinding
        $stmt->close();
        $conn->close();
    }
}
?>
