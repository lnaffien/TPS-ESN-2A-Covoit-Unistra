<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="css/editdata.css"> 
</head>

<?php include "src/View/header_logged.php" ?>

<body>
    <div class="PersonalDataModification">
        <div class="Background"></div>

        <h1 class="EditInfos">Modifier Mes Informations Personnelles</h1> 
        
        <form id="form" action='index.php' method="POST">
            <input type="hidden" name="action" value="homepage">
            <input type="image" class="Arrow1" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
        </form>
       
        <form id="form" action="" mehtod="POST">
            <input type="hidden" name="action_update_submit" value="update_submit">
           
            <input type="text" class="Nom" placeholder="Nom" name="nom" value="<?php echo $_SESSION['user']->__get('nom') ?>" required>        
            <input type="text" class="Prenom" name="prenom" placeholder="Prénom" value="<?php echo $_SESSION['user']->__get('prenom') ?>" required>   
            <input  type="email" class="Email" name="email" placeholder="E-mail" value="<?php echo $_SESSION['user']->__get('email') ?>" required>
            <input type="telephone" class="Telephone" name="telephone" placeholder="Téléphone" value="<?php echo ($_SESSION['user']->__get('telephone') != null) ? $_SESSION['user']->__get('telephone') : ''; ?>">   
                              
            <div class="Calendar">
                <input type="number" class ="CalendarInput" name="nagenda" placeholder="Numéro de Calendrier" min="1000" max="99999" value="<?php echo $_SESSION['user']->__get('nagenda') ?>" required>
                <button type="submit">
                    <img class="Info" src="images/info.svg">
                </button>
            </div>
    
            <div class="Password">
                <input type="password" class="PassInput" name="mdp" placeholder="Mot de passe">
                <button type="submit">
                    <img class="EyePass" src="images/eye.svg">
                </button>
            </div>
    
            <div class="PassConfirmation">
                <input type="password" class="PassConfirmationInput" name="confirm_mdp" placeholder="Confirmer le mot de passe">
                <button type="submit">
                    <img class="EyePassConf" src="images/eye.svg">
                </button>
            </div>

            <button  type="submit" class="ValiderButton" >Valider</button>
        </form>

        <form id="form" action="index.php" method="POST">
            <input type="hidden" name="action" value="homepage">
            <button class="AnnulerButton" type="submit">Annuler</button>
        </form>
          
    </div>        
</body>
</html>
