<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="css/connexion.css" />
</head>

<?php include "src/View/header_not_logged.php" ?>

<body>
  <div class="PageConnection">
      <div class="Background">
        <h1 class="BienvenueSurCovoitUnistra">Bienvenue sur Covoit’ Unistra !</h1>

        <form id="form" action='' method="POST">
          <input type="hidden" name="action_login_submit" value="login_submit">

          <div class="Email">
            <img class="EmailIcon" src="images/email.svg" alt="Email Icon">
            <!--div class="Line1"></div-->  
            <input type="email" name="email" placeholder="E-mail" class="EmailInput" required>         
          </div>

          <div class="Password">
            <img class="PasswordIcon" src="images/password.svg" alt="Password Icon">
            <!--div class="Line2"></div-->   
            <input type="password" name="mdp" placeholder="Mot de Passe" class="MotDePasseInput" required>                
          </div>       
          
          <button type="submit" class="ConnexionButton">Connexion</button>
        </form>

        <form id="form" action="index.php" method="POST">
          <input type="hidden" name="action" value="register">
          <button class="InscriptionButton" type="submit">Inscription</button>
        </form>        
      </div>
    </div>
  </div>
</body>

</html>
