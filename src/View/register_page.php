<!DOCTYPE html>
<html>

<body class="body4">

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