<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inloggen/The Wall</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Log in</h2>
</div>

<form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Gebruikersnaam</label>
        <input type="text" name="username" autofocus >
    </div>
    <div class="input-group">
        <label>Wachtwoord</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Inloggen</button>
    </div>
    <p>
        Nog geen account? <a href="register.php">Registreren</a>
    </p>
</form>
<div class="slideshow">
    <img class="mySlides" src="">
    <img class="mySlides" src="">
    <img class="mySlides" src="">
</div>

</body>
</html>