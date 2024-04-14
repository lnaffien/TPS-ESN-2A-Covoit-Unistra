<!DOCTYPE html>
<html>

<body class="body1">


    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="register">
        <input class="input-logpage" type="submit" value="S'inscrire" >
    </form>


    <main>

        <div class="flex">

            <form id="form" action='' method="POST">

                <input type="hidden" name="action_login_submit" value="login_submit">
                <h1> Bienvenue sur la page de connexion </h1><br><br>
                <input type="email" name="email" placeholder="Email" class="email-co" required><br>
                <input type="password" name="mdp" placeholder="Mot de passe" class="mdp-co" required><br>
                <input type="submit" value="Connexion"><br>

            </form>

        </div>

    </main>

</body>
</html>