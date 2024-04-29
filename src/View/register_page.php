<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php include "src/View/header_not_logged.html" ?>

<body>
    <div class="Background">
        <div class="TitleContainer">
            <form action='index.php' method="POST">
                <input type="hidden" name="action" value="login">
                <input type="image" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
            </form>

            <h1>Créer un Nouveau Compte</h1> 
        </div>

     <form action="" method="POST">
        <input type="hidden" name="action_register_submit" value="register_submit">
        <input type="text" name="nom" placeholder="Nom" required>        
        <input type="text" name="prenom" placeholder="Prénom" required>   
        <input  type="email" name="email" placeholder="E-mail" required>
        <input type="telephone" name="telephone" placeholder="Téléphone">   
                          
        <div class="Text-image">
            <input type="number" name="nagenda" placeholder="Numéro de Calendrier" min="1000" max="99999" required>
            <a href="src/View/Documentation_NumeroCalendrier.pdf" target="_blank">                
                <img src="images/info.svg" alt="calendar number help">
            </a>
        </div>

        <div class="Text-image">
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <input type='image' src="images/eye.svg">
        </div>

        <div class="Text-image">
            <input type="password" name="confirm_mdp" placeholder="Confirmer le mot de passe" required>
            <input type='image' src="images/eye.svg">
        </div>

        <button  type="submit">Valider</button>
    </form>      
    </div>
</div>

</body>
</html>