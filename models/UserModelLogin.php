<?php

class UserModel {
    public static function login($data) {
        try {
            // Connect to the database
            $dsn = "mysql:host=localhost;dbname=mvcproject";  // Update de database naam hier
            $conn = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            // Fetch the user data based on gebruikersnaam
            $stmt = $conn->prepare("SELECT * FROM users WHERE gebruikersnaam = ?");
            $stmt->execute([$data['gebruikersnaam']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and password matches
            if ($user && password_verify($data['wachtwoord'], $user['wachtwoord'])) {
                // Login successful, return user data or true
                return $user; // Return user details if needed
            } else {
                // Login failed
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}

// Example usage
$data = [
    'gebruikersnaam' => 'johndoe',
    'wachtwoord' => 'securepassword123',
];

$user = UserModel::login($data);
if ($user) {
    echo "Login successful. Welcome, " . $user['naam'] . "!";
} else {
    echo "Login failed. Please check your gebruikersnaam and wachtwoord.";
}