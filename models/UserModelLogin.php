<?php
 
class UserModelLogin {
    // Maakt verbinding met de database
    private static function connect() {
        try {
            $dsn = "mysql:host=localhost;dbname=mvcproject";
            return new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("Databaseverbinding mislukt.");
        }
    }
 
    // Login functie voor het verifiëren van de gebruiker
    public static function login($data) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE gebruikersnaam = ?");
            $stmt->execute([$data['gebruikersnaam']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
            // Controleer of de gebruiker bestaat en of het wachtwoord overeenkomt
            if ($user && password_verify($data['wachtwoord'], $user['wachtwoord'])) {
                return $user; // Retourneer gebruikersgegevens als de login succesvol is
            } else {
                // Login mislukt, voeg een foutmelding toe voor debugging
                error_log("Login mislukt voor gebruikersnaam: " . $data['gebruikersnaam']);
                return false; // Login mislukt
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
 
    // Slaat of update een gebruiker op (save)
    public static function save($data) {
        try {
            $conn = self::connect();
            if (isset($data['id'])) {
                // Update bestaande gebruiker
                $stmt = $conn->prepare("UPDATE users SET naam = ?, achternaam = ?, email = ?, gebruikersnaam = ?, wachtwoord = ? WHERE id = ?");
                return $stmt->execute([
                    $data['naam'],
                    $data['achternaam'],
                    $data['email'],
                    $data['gebruikersnaam'],
                    $data['wachtwoord'],
                    $data['id'],
                ]);
            } else {
                // Voeg nieuwe gebruiker toe
                $stmt = $conn->prepare("INSERT INTO users (naam, achternaam, email, gebruikersnaam, wachtwoord)
                                        VALUES (?, ?, ?, ?, ?)");
                return $stmt->execute([
                    $data['naam'],
                    $data['achternaam'],
                    $data['email'],
                    $data['gebruikersnaam'],
                    $data['wachtwoord'],
                ]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
 
    // Verwijdert een gebruiker op basis van ID (delete)
    public static function delete($id) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
 
    // Haalt de ID van een gebruiker op basis van gebruikersnaam (getId)
    public static function getId($gebruikersnaam) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT id FROM users WHERE gebruikersnaam = ?");
            $stmt->execute([$gebruikersnaam]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
 
    // Zoekt een gebruiker op basis van ID (findById)
    public static function findById($id) {
        try {
            $conn = self::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
 
    // Haalt alle gebruikers op (findAll)
    public static function findAll() {
        try {
            $conn = self::connect();
            $stmt = $conn->query("SELECT * FROM users");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
?>