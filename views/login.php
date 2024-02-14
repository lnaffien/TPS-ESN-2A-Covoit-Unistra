<!DOCTYPE html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <title> Page de connexion </title>
  
</head>
<body class="body1">

    <header class="header">

        <div class="flex justify-between align-center">

            <img src="images/maison.png" class="home-logo">

            <div>
                <h1 class="logo-unistra1"> COVOIT' </h1>
                <h1 class="logo-unistra2"> UNISTRA </h1>
            </div>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="register">
                <input class="input-logpage" type="submit" value="S'inscrire" >
            </form>

        </div>

    </header>

    <main>

        <div class="flex">

            <form id="form" action="index.php" method="POST">

                <input type="hidden" name="action" value="homepage_connection">
                <h1> Bienvenue sur la page de connexion </h1><br><br>
                <?php
                    // Vérification si la variable $_SESSION['error'] est définie
                    if(isset($_SESSION['error'])) {
                        echo '<p class="error">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
                    }
                ?>
                <input type="email" name="email" placeholder="Email" class="email-co" required><br>
                <input type="password" name="mdp" placeholder="Mot de passe" class="mdp-co" required><br>
                <input type="submit" value="Connexion" ><br>

            </form>

        </div>

    </main>

</body>
</html>