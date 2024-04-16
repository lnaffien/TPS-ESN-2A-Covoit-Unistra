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

<body class="body1" >

    <header class="header">

        <div class="flex justify-between align-center">

            <nav class="navbar">

                <img src="images/menu_burger.png" id="openBtn" class="menu-burger">

                <div id="mySidenav" class="sidenav">

                    <img src="images/menu_burger.png" id="closeBtn" class="menu-burger"><br>

                        <ul>
                            <li>
                                <form action="index.php" method="POST">
                                    
                                    <input type="hidden" name="action" value="admin">
                                    <input class="input-navbar" type="submit" value="admin">
                                </form>
                            </li>
                            <li>
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="action" value="logout">
                                    <input class="input-navbar" type="submit" value="Se déconnecter">
                                </form>
                            </li>
                        </ul>  

                </div>

            </nav>


            <div>
                <h1 class="logo-unistra1"> COVOIT' </h1>
                <h1 class="logo-unistra2"> UNISTRA </h1>
            </div>

            <div>
                <label class="user-logo"><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></label>
            </div>

            <div>

                <form  id="btnProfil" action="index.php" method="POST">
                        <input type="hidden" name="action" value="settings">
                        <button type="submit"> <img src="images/profil.png" class="logo-profil" alt="PROFIL"> </button>
                </form>

            </div>
            
        </div>
        
    </header>