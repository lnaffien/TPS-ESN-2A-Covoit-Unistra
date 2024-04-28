<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>

<?php include "src/View/header_logged.php" ?>

<body>
    <div class="Background">
        
        <form  action='index.php' method="POST">
            <input type="hidden" name="action" value="homepage">
            <input type="image" class="Arrow_back" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
        </form>

        <h1>Modifier mes informations personnelles</h1> 
       
        <form action="" mehtod="POST">
            <input type="hidden" name="action_update_submit" value="update_submit">
           
            <input type="text" placeholder="Nom" name="nom" value="<?php echo $_SESSION['user']->__get('nom') ?>" required>        
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $_SESSION['user']->__get('prenom') ?>" required>   
            <input  type="email" name="email" placeholder="E-mail" value="<?php echo $_SESSION['user']->__get('email') ?>" required>
            <input type="telephone" name="telephone" placeholder="Téléphone" value="<?php echo ($_SESSION['user']->__get('telephone') != null) ? $_SESSION['user']->__get('telephone') : ''; ?>">   
                              
            <div class="Text-image">
                <input type="number" name="nagenda" placeholder="Numéro de Calendrier" min="1000" max="99999" required>
                <input type='image' src="images/info.svg">
            </div>

            <div class="Text-image">
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type='image' src="images/eye.svg">
            </div>

            <div class="Text-image">
                <input type="password" name="confirm_mdp" placeholder="Confirmer le mot de passe" required>
                <input type='image' src="images/eye.svg">
            </div>

                <button  type="submit" >Valider</button>
            </form>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="homepage">
                <button type="submit">Annuler</button>
            </form>
          
    </div>        
</body>
</html>
