<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <title> Profil </title>

</head>
<body class="body3">

    <header class="header">

        <div class="flex justify-between align-center">

            <div class="flex MainPageBtn">

                <img src="images/profil.png" class="main-header-logo ">

                <form action="index.php" method="POST">
                    <input type="hidden" name="action" value="homepage">
                    <input class="input-mainpage" type="submit" value="Page Principale">
                </form>

            </div>

            <div>
                <h1 class="logo-unistra1"> COVOIT' </h1>
                <h1 class="logo-unistra2"> UNISTRA </h1>
            </div>

            <div>
                <label class="user-logo"> <?php echo $_SESSION["prenom"], ' ', $_SESSION["nom"]?> </label>
            </div>

        </div>
        
    </header>

    <main>
    
        <form id="form3" action='index.php' method="POST" onsubmit="if(document.getElementByName('ancienmdp').value && document.getElementByName('mdp').value && document.getElementByName('confmdp').value) {return validatePasswords();} else {return true;}">
        <input type="hidden" name="action" value="modifier_profil">

            <div class="flex align-center">

                <img src="images/maps.png" class="maps-logo">
                <h1> COORDONNÉES : </h1>

            </div><br><br>

            <div class="row">

                <div class="column">

                    <div class="align">
                        <label class="label-user1" for="nom" > Nom : </label>
                        <input type="text"  name="nom" value= <?php echo $_SESSION["nom"] ?> >
                    </div>

                    <div class="align">
                        <label class="label-user1" for="prenom" > Prénom : </label>
                        <input type="text"  name="prenom" value=<?php echo $_SESSION["prenom"] ?> >
                    </div>

                    <div class="align">
                        <label  class="label-user1" for="email" > E-mail : </label>
                        <input type="email" name="email" value=<?php echo $_SESSION["email"] ?> >
                    </div>

                    <div class="align">
                        <label  class="label-user1" for="numTel" > Téléphone : </label>
                        <input type="text" name="numTel" value="<?php echo isset($_SESSION['numTel']) ? $_SESSION['numTel'] : ''; ?>" >
                    </div>

                    <div class="align">
                        <label  class="label-user1" for="numCalendrier" > N° de calendrier : </label>
                        <input type="text" name="numCalendrier" value=<?php echo $_SESSION["numCalendrier"] ?> >
                    </div><br>
                    
                </div>

                <div class="column">

                    <div>

                        <div class="align">
                            <h2> Changez votre mot de passe : </h2>
                        </div><br>

                        <div class="align">
                            <?php
                                // Vérification si la variable $_SESSION['error'] est définie
                                if(isset($_SESSION['error'])) {
                                    echo '<p class="error">' . $_SESSION['error'] . '</p>';
                                    unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
                                }
                            ?>
                        </div>

                        <div class="align">
                            <label class="label-user1 label-mdp" for="ancienmdp" > Ancien mot de passe : </label>
                            <input type="password"  name="ancienmdp" value="" >
                        </div>

                        <div class="align">
                            <label  class="label-user1 label-mdp" for="mdp" > Nouveau mot de passe : </label>
                            <input type="password" name="mdp" value="<?php echo isset($_SESSION['mdp']) ? $_SESSION['mdp'] : ''; ?>" >
                        </div>

                        <div class="align">
                            <label  class="label-user1 label-mdp" for="confmdp" > Confirmation du mot de passe : </label>
                            <input type="password" name="confirm_mdp" value="" >
                        </div>

                    </div>

                </div>

            </div>                       

            <div class="flex justify-center">
                <input type="submit" value="Modifier">
            </div>
                        
        </form>

    </main>


</body>
</html>