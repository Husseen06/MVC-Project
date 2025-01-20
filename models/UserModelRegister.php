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
}
