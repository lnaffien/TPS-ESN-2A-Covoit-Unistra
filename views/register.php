<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <title> Page d'inscription </title>
</head>
<body class="body4">

    <header class="header">

        <div class="flex justify-between align-center">

            <img src="images/register.png" class="register-logo">

            <div>
                <h1 class="logo-unistra1"> COVOIT' </h1>
                <h1 class="logo-unistra2"> UNISTRA </h1>
            </div>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="login">
                <input class="input-registerpage" type="submit" value="Page d'accueil" >
            </form>

        </div>

    </header>

    <main>
        
        <div class="flex">

            <form id="form2" action="index.php" method="post" onsubmit="return validatePasswords()">

                <input type="hidden" name="action" value="register_new">
                <h1>Bienvenue sur la page d'inscription</h1><br>
                <input type="text"  name="nom" placeholder="Nom" required><br>
                <input type="text"  name="prenom" placeholder="Prénom" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="mdp" placeholder="Mot de passe" required><br>
                <input type="password" name="confirm_mdp" placeholder="Mot de passe" required><br>
                <input type="text" name="numCalendrier" placeholder="numCalendrier" required><br>
                <input type="text" name="numTel" placeholder="Numéro de téléphone" ><br>
                <input type="submit" value="S'inscrire"><br>

            </form>
        </div>
        
    </main>    

    <!-- Verifie que les deux mots de passe sont identiques (coté client) -->
    <script src="../js/validatePasswords.js"></script>

</body>
</html>