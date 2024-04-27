<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<?php include "src/View/header_not_logged.html" ?>

<body>
  <div class="Background">

    <h1>Bienvenue sur Covoit’ Unistra !</h1>

        <form action='' method="POST">
          <input type="hidden" name="action_login_submit" value="login_submit">

          <div class="Image-text">
            <img src="images/email.svg" alt="Email Icon">
            <input type="email" name="email" placeholder="E-mail" required>         
          </div>

          <div class="Image-text">
            <img src="images/password.svg" alt="Password Icon">
            <input type="password" name="mdp" placeholder="Mot de Passe" required>                
          </div>       
          
          <button type="submit">Connexion</button>
        </form>

        <form action="index.php" method="POST">
          <input type="hidden" name="action" value="register">
          <button type="submit">Inscription</button>
        </form>        
  </div>
</body>

</html>
