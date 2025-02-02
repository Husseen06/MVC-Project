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

// Haal de spelersgegevens op inclusief de nieuwe afbeeldingskolommen
$query = "SELECT * FROM players";
$stmt = $pdo->query($query);
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation</title>
    <link rel="stylesheet" href="css/formation.css">

    <link rel="icon" href="../afbeeldingen\FC_Barcelona.png">
</head>
<body>

    <div class="formation">
        <!-- Keeper -->
        <?php foreach ($players as $player): ?>
            <?php if ($player['id'] == 13): ?>
                <img src="<?php echo htmlspecialchars($player['img']); ?>" alt="keeper" class="kit keeper" 
                    data-id="<?php echo $player['id']; ?>" 
                    data-name="<?php echo htmlspecialchars($player['name']); ?>" 
                    data-tooltip-img="<?php echo htmlspecialchars($player['tooltip_img']); ?>" 
                    data-details-img="<?php echo htmlspecialchars($player['details_img']); ?>">
            <?php endif; ?>
        <?php endforeach; ?>
        
        <!-- Verdediging -->
        <div class="defenders">
            <?php foreach ($players as $player): ?>
                <?php if (in_array($player['id'], [3, 5, 2, 23])): ?>
                    <img src="<?php echo htmlspecialchars($player['img']); ?>" alt="kit <?php echo $player['id']; ?>" class="kit defender 
                    <?php 
                    if ($player['id'] == 3) { echo 'left-back'; }
                    elseif ($player['id'] == 5) { echo 'center-back'; }
                    elseif ($player['id'] == 2) { echo 'center-back-right'; }
                    elseif ($player['id'] == 23) { echo 'right-back'; }
                    ?>" data-id="<?php echo $player['id']; ?>" 
                    data-name="<?php echo htmlspecialchars($player['name']); ?>" 
                    data-tooltip-img="<?php echo htmlspecialchars($player['tooltip_img']); ?>" 
                    data-details-img="<?php echo htmlspecialchars($player['details_img']); ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <!-- Middenveld -->
        <div class="midfielders">
            <?php foreach ($players as $player): ?>
                <?php if (in_array($player['id'], [8, 17])): ?>
                    <img src="<?php echo htmlspecialchars($player['img']); ?>" alt="kit <?php echo $player['id']; ?>" class="kit midfielder 
                    <?php 
                    if ($player['id'] == 8) { echo 'left-center-mid'; }
                    elseif ($player['id'] == 17) { echo 'right-center-mid'; }
                    ?>" data-id="<?php echo $player['id']; ?>" 
                    data-name="<?php echo htmlspecialchars($player['name']); ?>" 
                    data-tooltip-img="<?php echo htmlspecialchars($player['tooltip_img']); ?>" 
                    data-details-img="<?php echo htmlspecialchars($player['details_img']); ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    
        <!-- Aanval -->
        <div class="forwards">
            <?php foreach ($players as $player): ?>
                <?php if (in_array($player['id'], [11, 9, 19, 20])): ?>
                    <img src="<?php echo htmlspecialchars($player['img']); ?>" alt="kit <?php echo $player['id']; ?>" class="kit forward 
                    <?php 
                    if ($player['id'] == 11) { echo 'left-wing'; }
                    elseif ($player['id'] == 20){ echo 'center-forward'; }
                    elseif ($player['id'] == 19) { echo 'right-wing'; }
                    elseif ($player['id'] == 9) { echo 'striker'; }
                    ?>" data-id="<?php echo $player['id']; ?>" 
                    data-name="<?php echo htmlspecialchars($player['name']); ?>" 
                    data-tooltip-img="<?php echo htmlspecialchars($player['tooltip_img']); ?>" 
                    data-details-img="<?php echo htmlspecialchars($player['details_img']); ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="tooltip" class="tooltip"></div>

    <script src="script.js"></script>
</body>
</html>
