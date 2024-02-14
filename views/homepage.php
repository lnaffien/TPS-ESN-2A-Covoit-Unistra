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
                    <?php foreach ($week as $day) { ?>
                        <div class="agendaColumn">
                            <?php $nomsJoursFr =array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');
                            $nomJour = $nomsJoursFr[(new \DateTime($day))->format('l')] ?>
                            <div class="agendaHeader"><?php echo $nomJour . " " . $day; ?></div>
                            <?php foreach ($datasAgendas as $datasUser) { ?>
                                <?php if ($datasUser['dateJour'] == $day) { ?>
                                <div class="agendaItem">
                                    <div class="rectangle-form">
                                        
                                        <div class="flex align-center">
                                            <label class="label-user" > <?php echo $datasUser['user']['nom'] . " " . $datasUser['user']['prenom'] ?>  </label>
                                        </div><br>

                                    <div class="flex">
                                        <label class="heure"> <?php echo $datasUser['correspondance']['journeeTotaleDebut'] ->format('H:i') ?> </label>
                                    </div>

                                    <?php $id = 'user' . $datasUser['user']['idUser'] . '_on_' . str_replace('-', '_', $datasUser['dateJour']); ?>
                                    <div id="<?php echo $id; ?>" class="flex">
                                        <!-- La position et la longueur de la barre peut se faire avec les variables de type DateTime
                                        Relation proportionnel entre le début : 
                                        $datasUser['correspondance']['journeeTotaleDébut'] <- Minimum des débuts
                                        et la fin :
                                        $datasUser['correspondance']['journeeTotaleFin'] <- Maximum des fins

                                            barre 1 :
                                            $datasUser['calendarCurrentUserData']['heureDebut']
                                            $datasUser['calendarCurrentUserData']['heureFin']

                                        barre 2 :
                                        $datasUser['calendarUserData']['heureDebut']
                                        $datasUser['calendarUserData']['heureFin']
                                        
                                        barre 3 : 
                                        $datasUser['correspondance']['heureDebutCorrespondance'] <- Correspondance = 0 ou non, elle renverra le second horaire à afficher
                                        $datasUser['correspondance']['heureFinCorrespondance'] <- Correspondance = 0 ou non, elle renverra le troisième horaire à afficher
                                        -->
                                        <div class="flex">
                                            <div class="barre-trajet1"></div>
                                            <div class="barre-trajet2"></div> 
                                            <div class="barre-trajet3"></div>
                                        </div>
                                        
                                        <?php
                                            // Récupération des horaires depuis PHP
                                            $jour = $datasUser['dateJour'];
                                            $journeeTotaleDebut = $datasUser['correspondance']['journeeTotaleDebut'] ->format('H:i');
                                            $journeeTotaleFin = $datasUser['correspondance']['journeeTotaleFin']->format('H:i');
                                            $heureDebut1 = $datasUser['calendarCurrentUserData']['heureDebut']->format('H:i');
                                            $heureFin1 = $datasUser['calendarCurrentUserData']['heureFin']->format('H:i');
                                            $heureDebut2 = $datasUser['calendarUserData']['heureDebut']->format('H:i');
                                            $heureFin2 = $datasUser['calendarUserData']['heureFin']->format('H:i');
                                            $heureDebut3 = $datasUser['correspondance']['heureDebutCorrespondance']->format('H:i');
                                            $heureFin3 = $datasUser['correspondance']['heureFinCorrespondance']->format('H:i');

                                            

                                            // Calcul des durées en minutes
                                            $journeeTotaleDuree = 540;
                                            $duree1 = (strtotime($heureFin1) - strtotime($heureDebut1)) / 60;
                                            $duree2 = (strtotime($heureFin2) - strtotime($heureDebut2)) / 60;
                                            $duree3 = (strtotime($heureFin3) - strtotime($heureDebut3)) / 60;

                                            // Calcul des hauteurs en pixels
                                            $hauteur1 = $duree1 / $journeeTotaleDuree * 250; // 250 pixels étant la hauteur maximale des barres
                                            $hauteur2 = $duree2 / $journeeTotaleDuree * 250;
                                            $hauteur3 = $duree3 / $journeeTotaleDuree * 250;

                                            $position1 = (strtotime($heureDebut1) - strtotime($journeeTotaleDebut)) / 60 / $journeeTotaleDuree * 250;

                                            $position2 = (strtotime($heureDebut2) - strtotime($journeeTotaleDebut)) / 60 / $journeeTotaleDuree * 250;
                                            $position3 = (strtotime($heureDebut3) - strtotime($journeeTotaleDebut)) / 60 / $journeeTotaleDuree * 250;

/*                                             echo $duree1 . '<br>';
                                            echo $duree2 . '<br>';
                                            echo $duree3 . '<br>';
                                            echo $hauteur1 . '<br>';
                                            echo $hauteur2 . '<br>';
                                            echo $hauteur3 . '<br>'; */

                                        ?>

                                        <script>
                                            var jour = <?php echo json_encode($jour); ?>;
                                            var journeeTotaleDebut = <?php echo json_encode($journeeTotaleDebut); ?>;
                                            var journeeTotaleFin = <?php echo json_encode($journeeTotaleFin); ?>;
                                            var heureDebut1 = <?php echo json_encode($heureDebut1); ?>;
                                            var heureFin1 = <?php echo json_encode($heureFin1); ?>;
                                            var heureDebut2 = <?php echo json_encode($heureDebut2); ?>;
                                            var heureFin2 = <?php echo json_encode($heureFin2); ?>;
                                            var heureDebut3 = <?php echo json_encode($heureDebut3); ?>;
                                            var heureFin3 = <?php echo json_encode($heureFin3); ?>;

                                            var journeeTotaleDuree = <?php echo json_encode($journeeTotaleDuree); ?>;
                                            var duree1 = <?php echo json_encode($duree1); ?>;
                                            var duree2 = <?php echo json_encode($duree2); ?>;
                                            var duree3 = <?php echo json_encode($duree3); ?>;

                                            var hauteur1 = <?php echo json_encode($hauteur1); ?>;
                                            var hauteur2 = <?php echo json_encode($hauteur2); ?>;
                                            var hauteur3 = <?php echo json_encode($hauteur3); ?>;

                                            // Calcul de la position des barres en pixels
                                            var position1 = <?php echo json_encode($position1); ?>;
                                            var position2 = <?php echo json_encode($position2); ?>;
                                            var position3 = <?php echo json_encode($position3); ?>;

                                            // Calcul de la hauteur totale de chaque barre
                                            var hauteurTotale1 = hauteur1 + position1;
                                            var hauteurTotale2 = hauteur2 + position2;
                                            var hauteurTotale3 = hauteur3 + position3;

                                            console.table({
                                                jour: jour,
                                                journeeTotaleDebut: journeeTotaleDebut,
                                                journeeTotaleFin: journeeTotaleFin,
                                                heureDebut1: heureDebut1,
                                                heureFin1: heureFin1,
                                                heureDebut2: heureDebut2,
                                                heureFin2: heureFin2,
                                                heureDebut3: heureDebut3,
                                                heureFin3: heureFin3,
                                                journeeTotaleDuree: journeeTotaleDuree,
                                                duree1: duree1,
                                                duree2: duree2,
                                                duree3: duree3,
                                                hauteur1: hauteur1,
                                                hauteur2: hauteur2,
                                                hauteur3: hauteur3,
                                                position1: position1,
                                                position2: position2,
                                                position3: position3,
                                                hauteurTotales1: hauteurTotale1,
                                                hauteurTotales2: hauteurTotale2,
                                                hauteurTotales3: hauteurTotale3,
                                            })

   /*                                          // Ajustement de la position de chaque barre
                                            document.querySelector('.barre-trajet1').style.top = position1 + 'px';
                                            document.querySelector('.barre-trajet1').style.bottom = 250 - hauteurTotale1 + 'px';
                                            document.querySelector('.barre-trajet2').style.top = position2 + 'px';
                                            document.querySelector('.barre-trajet2').style.bottom = 250 - hauteurTotale2 + 'px';
                                            document.querySelector('.barre-trajet3').style.top = position3 + 'px';
                                            document.querySelector('.barre-trajet3').style.bottom = 250 - hauteurTotale3 + 'px';
 */
                                     
 
                                            // Modification des propriétés CSS des barres
/*                                             var trajet1 = document.querySelector('.barre-trajet1')
                                            var trajet2 = document.querySelector('.barre-trajet2')
                                            var trajet3 = document.querySelector('.barre-trajet3') */

                                            var barreTrajet1_<?php echo $id; ?> = document.querySelector('#<?php echo $id; ?> .barre-trajet1');
                                            var barreTrajet2_<?php echo $id; ?> = document.querySelector('#<?php echo $id; ?> .barre-trajet2');
                                            var barreTrajet3_<?php echo $id; ?> = document.querySelector('#<?php echo $id; ?> .barre-trajet3');


/*                                             // Appliquer les styles calculés aux éléments HTML correspondants
                                            trajet1.style.height = hauteur1 + 'px';
                                            trajet1.style.top = position1 + 'px';
                                            trajet2.style.height = hauteur2 + 'px';
                                            trajet2.style.top = position2 + 'px';
                                            trajet3.style.height = hauteur3 + 'px';
                                            trajet3.style.top = position3 + 'px'; */

                                             // Appliquer les styles calculés aux éléments HTML correspondants
                                            barreTrajet1_<?php echo $id; ?>.style.height = hauteur1 + 'px';
                                            barreTrajet1_<?php echo $id; ?>.style.top = position1 + 'px';
                                            barreTrajet2_<?php echo $id; ?>.style.height = hauteur2 + 'px';
                                            barreTrajet2_<?php echo $id; ?>.style.top = position2 + 'px';
                                            barreTrajet3_<?php echo $id; ?>.style.height = hauteur3 + 'px';
                                            barreTrajet3_<?php echo $id; ?>.style.top = position3 + 'px';

                                            //document.querySelector('.barre-trajet3').style.top = hauteur1 / 250 * 180 + 'px'; // Positionnement de la barre 3 par rapport à la barre 1 
                                        </script>
                                        <div class="flex flex-column justify-evenly">
                                            <label class="heure"> <?php echo $datasUser['correspondance']['heureDebutCorrespondance'] ->format('H:i') ?> </label>
                                            <label class="heure"> <?php echo $datasUser['correspondance']['heureFinCorrespondance'] ->format('H:i') ?> </label>
                                        </div> 
                                        <div class="flex align-center">
                                        
                                            <div>
                                                <img src="images/feu.png" class="img-feu">
                                            </div>

                                                <div class="flex-column">
                                                    <?php switch($datasUser['correspondance']['etat']){
                                                            case 0 :?>
                                                                <div class="rond-rouge-transparent"></div>
                                                                <div class="rond-orange"></div>
                                                                <div class="rond-vert"></div>
                                                            <?php break;
                                                            case 1 :?>
                                                                <div class="rond-rouge"></div>
                                                                <div class="rond-orange-transparent"></div>
                                                                <div class="rond-vert"></div>
                                                            <?php break;
                                                            case 2 :?>
                                                                <div class="rond-rouge"></div>
                                                                <div class="rond-orange"></div>
                                                                <div class="rond-vert-transparent"></div>
                                                            <?php break;
                                                            default :?>
                                                                <div class="rond-rouge"></div>
                                                                <div class="rond-orange"></div>
                                                                <div class="rond-vert"></div>
                                                            <?php break;
                                                    }?>
                                                </div>
                                            </div>

                                            <div class="flex flex-column">
                                                <label class="null-comp"> <?php echo $datasUser['correspondance']['texte'] ?> </label>
                                                <label class="half-comp">  </label>
                                                <label class="full-comp"> <?php echo $datasUser['correspondance']['pourcentage'] ?> % </label>
                                            </div>

                                        </div>

                                        <div class="flex">
                                            <label class="heure"> <?php echo $datasUser['correspondance']['journeeTotaleFin'] ->format('H:i') ?> </label>
                                        </div>

                                        <div>
                                            <label class="contact"> <?php echo $datasUser['user']['email'] ?> </label>
                                        </div>
                                        <div>
                                            <label class="contact"> <?php echo $datasUser['user']['numTel'] ?> </label>
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
