<!DOCTYPE html>
<html>

<body class="body1">



    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="register">
        <input class="input-logpage" type="submit" value="S'inscrire" >
    </form>


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