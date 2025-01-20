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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="dashboard">
    <h1>Welkom op je Dashboard, <?php echo htmlspecialchars($user['naam']); ?>!</h1>

    <div class="dashboard-content">
      <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
      <p>Gebruikersnaam: <?php echo htmlspecialchars($user['gebruikersnaam']); ?></p>
    </div>

    <div class="actions">
      <a href="profile.php" class="button">Profiel bewerken</a>
      <a href="logout.php" class="button">Uitloggen</a>
    </div>
  </div>
</body>

</html>