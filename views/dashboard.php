<?php
session_start();
 
// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Stuur niet-ingelogde gebruikers terug naar de loginpagina
    exit();
}
 
// Haal gebruikersinformatie op uit de sessie
$user = $_SESSION['user'];
?>
 
<!DOCTYPE html>
<html lang="nl">
 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Dashboard</title>
</head>
 
<body>

<a href="index.php" class="home-button">
    <i class="fas fa-home"></i>
  </a>

  <div class="dashboard-box">
    <h1>Welkom, <?php echo htmlspecialchars($user['gebruikersnaam']); ?>!</h1>
    <p class="dashboard-content">Wat wil je vandaag doen?</p>
 
    <div class="actions">
      <a href="profile.php" class="button">
        <i class="fas fa-user"></i> Profiel
      </a>
      <a href="settings.php" class="button">
        <i class="fas fa-cog"></i> Instellingen
      </a>
      <a href="logout.php" class="button logout">
        <i class="fas fa-sign-out-alt"></i> Uitloggen
     </a> 
    </div>
  </div>
</body>
 
</html>
 
 