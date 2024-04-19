<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <title> Page principale </title>

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
                <label class="user-logo"> <?php echo $_SESSION["prenom"], ' ', $_SESSION["nom"]?>  </label>
            </div>

            <div>

                <form  id="btnProfil" action="index.php" method="POST">
                        <input type="hidden" name="action" value="profil">
                        <button type="submit"> <img src="images/profil.png" class="logo-profil" alt="PROFIL"> </button>
                </form>

            </div>
            
        </div>
        
    </header>
    <main>

        <section>

            <form action="index.php" method="POST">

                <div class="flex justify-center">

                    <input type="search" name="BarreR" placeholder="Recherche..." class="BarreR" value=<?php echo $_SESSION['userSelected'];?>>

                </div>
                <div class="flex justify-center">
                    <?php
                            // Vérification si la variable $_SESSION['error'] est définie
                            if(isset($_SESSION['error'])) {
                                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                                unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
                            }
                    ?>
                </div>
                <div class="flex align-center justify-between">

                    <div class="align-date">

                        <input class="input_date" id="inputDate" type="date" name="date" value=<?php echo $_SESSION['dateSelected'];?>>

                    </div>

                    <div>

                        <input type="hidden" name="action" value="homepage_filters">
                        <input class="input-barre-date" type="submit" value="MàJ" >

                    </div>

                </div>

            </form>

        </section>

        <section>

            <form id="form1">
                <div class="agendaContainer">

<!------------------------------------------------------------------------------------------------------------------------------------>
                    <?php foreach ($week as $day) { ?>
                        <div class="agendaColumn">
                            <?php $currentDayName_fr = $daysName_fr[(new \DateTime($day))->format('l')] ?>
                            <div class="agendaHeader"><?php echo $currentDayName_fr . " " . $day; ?></div>

                            <?php foreach ($datasAgendas as $datasUser){ ?>
                                <?php if ($datasUser['dateJour'] == $day) { ?>
                                    <div class="agendaItem">
                                        <div class="rectangle-form">            
                                        
                                        <div class="flex align-center">
                                            <label class="label-user" ><?php echo $datasUser['user']['nom'] . " " . $datasUser['user']['prenom'] ?></label>
                                        </div><br>

                                    <div class="flex">
                                        <label class="heure">Heure debut journee</label>
                                    </div>

                                    <div id="1234" class="flex"> <!-- id de l'utilisateur + date du jour ? -->
                                       
                                        <div class="flex">
                                            <div class="barre-trajet1"></div>
                                            <div class="barre-trajet2"></div> 
                                            <div class="barre-trajet3"></div>
                                        </div>
                                        
                                        <?php
                                        // Calcul de la hauteur des barres 
                                            // Récupération des horaires depuis PHP

                                            // Calcul des durées en minutes

                                            // Calcul des hauteurs en pixels

                                            /*echo $duree1 . '<br>';
                                            echo $duree2 . '<br>';
                                            echo $duree3 . '<br>';
                                            echo $hauteur1 . '<br>';
                                            echo $hauteur2 . '<br>';
                                            echo $hauteur3 . '<br>'; */

                                        ?>

                                        <script>
                                        // Pas besoin de ce script si ?
                                        // Je crois qu'il centre les barres en fonction de l'heure de debut et de fin
                                        // Y compris pour une 3eme barre

                                            // Calcul de la position des barres en pixels


                                            // Calcul de la hauteur totale de chaque barre

                                            // Tableau des donnees a afficher


                                             // Appliquer les styles calculés aux éléments HTML correspondants

                                        </script>
                                        <div class="flex flex-column justify-evenly">
                                            <label class="heure">Heure de debut de l'ami</label>
                                            <label class="heure">Heure de fin de l'ami</label>
                                        </div> 
                                        <div class="flex align-center">
                                        
                                            <div>
                                                <img src="images/feu.png" class="img-feu">
                                            </div>

                                                <div class="flex-column">
                                                    <?php 
                                                    // switch case pour afficher la couleur du feu en fonction de la correspondance

                                                    ?>
                                                </div>
                                            </div>

                                            <div class="flex flex-column">
                                                <label class="null-comp"> Texte de correspondance </label>
                                                <label class="half-comp">  </label>
                                                <label class="full-comp"> Pourcentage de correspondance </label>
                                            </div>

                                        </div>

                                        <div class="flex">
                                            <label class="heure"> Heure totale de la fin de journee </label>
                                        </div>

                                        <div>
                                            <label class="contact"> Email de l'ami </label>
                                        </div>
                                        <div>
                                            <label class="contact"> Telephone de l'ami </label>
                                        </div>

                                    </div> 
                                </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </section>
    </main>
</body>

<script>

    let today = new Date();
    let day = today.getDate();
    let month = today.getMonth() + 1;
    let year = today.getFullYear();
    if (day < 10) 
    {
        day = '0' + day;
    }

    if (month < 10) 
    {
        month = '0' + month;
    }

    let formattedDate = year + '-' + month + '-' + day;
    //document.getElementById('inputDate').value = formattedDate;

    var sidenav = document.getElementById("mySidenav");
    var openBtn = document.getElementById("openBtn");
    var closeBtn = document.getElementById("closeBtn");

    var sidenav_profil = document.getElementById("mySidenavP");
    var openBtnP = document.getElementById("openBtnP");
    var closeBtnP = document.getElementById("closeBtnP");

    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;

    openBtnP.onclick = openNavP;
    closeBtnP.onclick = closeNavP;

    /* Set the width of the side navigation to 250px */
    function openNav() 
    {
        sidenav.classList.add("active");
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() 
    {
        sidenav.classList.remove("active");
    }

    function openNavP()
    {
        sidenav_profil.classList.add("active");
    }

    function closeNavP()
    {
        sidenav_profil.classList.remove("active");
    }
    
</script>



</html>
