<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Registreren</title>
</head>

<body>
  <div class="box">
    <h1>Registratie</h1>
    <form method="POST" action="../controllers/UserController.php">
    <div class="txt_field">
        <input type="text" required id="naam" name="naam" />
        <span></span>
        <label for="naam">Naam</label>
      </div>
      <div class="txt_field">
        <input type="text" required id="achternaam" name="achternaam" />
        <span></span>
        <label for="achternaam">Achternaam</label>
      </div>
      <div class="txt_field">
        <input type="email" required id="email" name="email" />
        <span></span>
        <label for="email">Email</label>
      </div>
      <div class="txt_field">
        <input type="text" required id="gebruikersnaam" name="gebruikersnaam" />
        <span></span>
        <label for="gebruikersnaam">Gebruikersnaam</label>
      </div>
      <div class="txt_field">
        <input type="password" required id="wachtwoord" name="wachtwoord" />
        <span></span>
        <label for="wachtwoord">Wachtwoord</label>
      </div>
      <input type="submit" value="Registreren" name="register">
      <div class="signup_link">
        Al een account? <a href="login.html">Inloggen</a>
      </div>
    </form>
  </div>
</body>

</html>
