<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Login</title>
</head>
<body>
  <div class="box">
    <h1>Login</h1>
    <form method="POST" action="../controllers/UserController.php">
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
      <input type="submit" value="Inloggen" name="inloggen">
      <div class="signup_link">
       Nog geen account? <a href="register.php">registreren</a>
      </div>
    </form>
  </div>
</body>
</html>
