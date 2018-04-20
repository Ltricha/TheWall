<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Registreren</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Gebruikersnaam</label>
  	  <input type="text" name="username" placeholder="Voer hier uw gebruikersnaam in" autofocus value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Emailadres</label>
  	  <input type="email" name="email" placeholder="Voer hier uw emailadres in" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Wachtwoord</label>
  	  <input type="password" name="password_1" placeholder="Voer hier een wachtwoord in">
  	</div>
  	<div class="input-group">
  	  <label>Wachtwoord bevestigen</label>
  	  <input type="password" name="password_2" placeholder="Bevestig uw wachtwoord">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registreren</button>
  	</div>
  	<p>
  		Al een account? <a href="login.php">Log in</a>
  	</p>
  </form>
</body>
</html>