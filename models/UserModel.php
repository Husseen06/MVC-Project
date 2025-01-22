<?php

class UserModel {
    private static $conn;

    // Maak verbinding met de database (Singleton)
    private static function connect() {
        if (self::$conn === null) {
            try {
                $dsn = "mysql:host=localhost;dbname=mvcproject";
                self::$conn = new PDO($dsn, 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);
            } catch (PDOException $e) {
                error_log('Database connectie mislukt: ' . $e->getMessage());
                die("Verbinding mislukt");
            }
        }
        return self::$conn;
    }

    // Save (voegt nieuwe gebruiker toe of werkt bij)
    public static function save($data) {
        try {
            $conn = self::connect();

            // Check of de gebruiker al bestaat via gebruikersnaam
            $stmt = $conn->prepare("SELECT id FROM users WHERE gebruikersnaam = ?");
            $stmt->execute([$data['gebruikersnaam']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Update bestaande gebruiker
                $stmt = $conn->prepare("UPDATE users SET naam = ?, achternaam = ?, email = ?, wachtwoord = ? WHERE id = ?");
                return $stmt->execute([
                    $data['naam'],
                    $data['achternaam'],
                    $data['email'],
                    $data['wachtwoord'],
                    $user['id']
                ]);
            } else {
                // Voeg nieuwe gebruiker toe
                $stmt = $conn->prepare("INSERT INTO users (naam, achternaam, email, gebruikersnaam, wachtwoord) VALUES (?, ?, ?, ?, ?)");
                return $stmt->execute([
                    $data['naam'],
                    $data['achternaam'],
                    $data['email'],
                    $data['gebruikersnaam'],
                    $data['wachtwoord'],
                ]);
            }
        } catch (PDOException $e) {
            error_log('Fout tijdens save: ' . $e->getMessage());
            return false;
        }
    }

    // Delete (verwijder gebruiker)
    public static function delete($id) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log('Fout tijdens delete: ' . $e->getMessage());
            return false;
        }
    }

    // GetID (haalt gebruiker op via ID)
    public static function getID($id) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Fout tijdens getID: ' . $e->getMessage());
            return false;
        }
    }

    // FindByID (haalt gebruiker op via ID, hetzelfde als getID)
    public static function findByID($id) {
        return self::getID($id);  // Gebruik getID voor de implementatie
    }

    // FindAll (haalt alle gebruikers op)
    public static function findAll() {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Fout tijdens findAll: ' . $e->getMessage());
            return false;
        }
    }
}
?>
