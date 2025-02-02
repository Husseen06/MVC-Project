<?php
// Maak de verbinding met de database
$host = 'localhost';
$dbname = 'mvcproject';
$username = 'root';
$password = '';

try {
    // Maak een nieuwe PDO-verbinding
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Fout bij het verbinden met de database: " . $e->getMessage();
    exit();
}

// Haal de speler-ID op uit de URL
if (isset($_GET['id'])) {
    $playerId = $_GET['id'];
    $query = "SELECT * FROM players WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $playerId, PDO::PARAM_INT);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Geen speler gevonden.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Details</title>
    <link rel="stylesheet" href="css/player.css">
    <link rel="icon" href="../afbeeldingen\FC_Barcelona.png">
</head>
<body>
    <div class="player-details">
        <img id="player-img" src="<?php echo htmlspecialchars($player['details_img']); ?>" alt="Player Image">
        <h1 id="player-name"><?php echo htmlspecialchars($player['name']); ?></h1>
        <div id="stats">
            <p id="player-matches">Matches: <span><?php echo $player['matches']; ?></span></p>

            <?php if ($playerId == 13): // Keeper-specifieke statistieken ?>
                <p id="player-clean-sheets">Clean Sheets: <span><?php echo $player['clean_sheets']; ?></span></p>
                <p id="player-saves">Saves: <span><?php echo $player['saves']; ?></span></p>
            <?php else: ?>
                <p id="player-goals">Goals: <span><?php echo $player['goals']; ?></span></p>
                <p id="player-assists">Assists: <span><?php echo $player['assists']; ?></span></p>
            <?php endif; ?>
        </div>
        <a href="javascript:history.back()" class="back-button">
        <span>&larr;</span> Terug naar formatie
    </a>
</div>

    
</body>
</html>
