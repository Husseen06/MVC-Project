<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user']; // Haal de gebruikersinformatie op
    // Placeholder profielfoto als er geen echte is
    $profilePicture = $user['profielfoto'] ?? 'default-profile.png'; // Zorg dat 'default-profile.png' bestaat
} else {
    $user = null; // Geen gebruiker ingelogd
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FC Barcelona</title>
    <link rel="icon" href="../afbeeldingen\FC_Barcelona.png">

    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <?php if ($user): ?>
            <!-- Profielfoto en gebruikersnaam -->
            <div class="user-info">
                <img src="uploads/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profielfoto" class="profile-pic">
             
                <a href="dashboard.php" style="text-decorations:none; color: #E50914;></   <span class="username">@<?php echo htmlspecialchars($user['gebruikersnaam']); ?></span> 
                </a>    </div>
        <?php else: ?>
            <!-- Login-knop -->
            <a href="login.php" class="login-btn">
                <i class="fa-solid fa-user"></i>
            </a>
        <?php endif; ?>
    </div>

    <div class="container">
        <div class="text-section">
            <h1>Mes Que Un Club</h1>
            <p>
                Welkom bij FC Barcelona<br>
                Meer dan een club. Beleef de passie, trots en geschiedenis van Barça.<br>
                Blijf op de hoogte van het laatste nieuws, wedstrijden en verhalen.<br>
                Visca el Barça!
            </p>
        </div>
        <div class="barcalogo">
            <img src="../afbeeldingen/fc_barcelona.png" alt="FC Barcelona Logo">
        </div>
        <div class="player">
            <img src="../afbeeldingen/barca.png" alt="catculer">
        </div>
    </div>
</body>
</html>
