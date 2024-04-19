<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <link rel="stylesheet" href="css/editdata.css">
</head>

<?php include "src/View/header_not_logged.html" ?>

<body>
    <div class="PersonalDataModification">
        <div class="Background">
        <h1 class="EditInfos">Créer un Nouveau Compte</h1> 

        <form id="form" action='index.php' method="POST">
            <input type="hidden" name="action" value="login">
            <input type="image" class="Arrow1" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
        </form>
          
     <form id="form" action="" method="POST" class="RegistrationForm">
        <input type="hidden" name="action_register_submit" value="register_submit">
               
        <input type="text" class="Nom" name="nom" placeholder="Nom" required>        
        <input type="text" class="Prenom" name="prenom" placeholder="Prénom" required>   
        <input  type="email" class="Email" name="email" placeholder="E-mail" required>
        <input type="telephone" class="Telephone" name="telephone" placeholder="Téléphone">   
                          
        <div class="Calendar">
            <input type="number" class ="CalendarInput" name="nagenda" placeholder="Numéro de Calendrier" min="1000" max="99999" required>
            <button type="submit">
                <img class="Info" src="images/info.svg">
            </button>
        </div>

        <div class="Password">
            <input type="password" class="PassInput" name="mdp" placeholder="Mot de passe" required>
            <button type="submit">
                <img class="EyePass" src="images/eye.svg">
            </button>
        </div>

        <div class="PassConfirmation">
            <input type="password" class="PassConfirmationInput" name="confirm_mdp" placeholder="Confirmer le mot de passe" required>
            <button type="submit">
                <img class="EyePassConf" src="images/eye.svg">
            </button>
        </div>

        <button  type="submit" class="ValiderButton" >Valider</button>
    </form>      
    </div>
  </div>
</div>

</body>
</html>