<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametres</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php include "src/View/header_logged.php" ?>

<body>
  <div class="Background">       

    <form action='index.php' method="POST">
      <input type="hidden" name="action" value="homepage">
      <input type="image" class="Arrow_back" src="images/arrow.svg" alt="Arrow_back"></img> 
    </form>  

    <h1 class="Parametres">Paramètres</h1>

    <div class="BackgroundRow">
      <div>
        <img class="Photo" src="images/profileuser.svg">
          
        <h1>
          <?php print_r($_SESSION['user']->__get('nom') . '<br/>' . $_SESSION['user']->__get('prenom'));?>
        </h1>  

          <div>
            <h2>Téléphone :</h2>
            <p><?php print_r($_SESSION['user']->__get('telephone'))?></p>
          </div>

          <div>
            <h2>Mail :</h2>
            <p><?php print_r($_SESSION['user']->__get('email'))?></p>
          </div>

          <div>
            <h2>Numéro de calendrier :</h2>
            <p><?php print_r($_SESSION['user']->__get('nagenda'))?></p>
          </div>  
      </div>  
        
    <div>
      <form action="index.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="submit" value="Modifier mes informations personnelles">
      </form>   

      <form action="index.php" method="POST">
        <input type="hidden" name="action" value="historique">
        <input type="submit" value ="Historique annuel">
      </form>   

      <form action="index.php" method="POST">
        <input type="hidden" name="action" value="login">
        <input type="submit" value='Supprimer mon compte'>
      </form>   
    </div>
</div>

  </div>
</body>
</html>
