<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/popup.css">
    </head>

    <?php include "src/View/header_logged.php" ?>
    
<body>
    <div class="Align_left_center">
        <form id="form" action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="pick_calendar_date">
            <input type="date" value="<?php echo $_SESSION['dateSelected']['start']->format('Y-m-d') ?>" class="CalendarButton">
        </form>
        
        <form action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="reload_calendar_data">
            <input type="image" class="RefreshButton" src="images/refresh.svg" alt="Refresh Icon">
        </form>

        <h1>Semaine du <?php echo $_SESSION['dateSelected']['start']->format('d/m') ?> au <?php echo $_SESSION['dateSelected']['end']->format('d/m Y') ?></h1>
    </div>
    
    <ul>

        <?php
        foreach($_SESSION['dateSelected']['period'] as $date)
            {
                print_r("<br/>");

            ?>
                <li>

                <h1><?php print_r($date->format('l')) ?></h1>

                    <div class="DayRectangle">

                        <div>
                            <div></div>
                            <div class="Time">
                                <h2>8h00</h2> 
                                <h2>18h00</h2>
                            </div>
                            <div></div>
                        </div> 

                        <ul>
                            
                            <li class="UserRow"> 
                                <h2><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>     
                                                          
                                                      
                                <div class="DayTimeRectangle">
                                    
                                
                                   <!--h3>Start Time: <!?php echo $date->__get_start_time()->format('H:i:s'); ?><--/h3> 
                                   <h3>End Time: <!?php echo $date->__get_end_time()->format('H:i:s'); ?></h3--> 
                                </div>

                                <script src="js/jauge.js"></script>
                                <script>
                                    
                                    var date = "<?php echo $date->format('Y-m-d'); ?>";
                                    var start_time = "<?php echo $_SESSION[$date->format('Y-m-d')]['start_time']; ?>";
                                    var end_time = "<?php echo $_SESSION[$date->format('Y-m-d')]['end_time']; ?>";
                                    var start_compatibility = 0;
                                    var end_compatibility = 0;

                                    resizeAndColor(start_time, end_time, start_compatibility, end_compatibility);
                                </script>
                                <div></div>
                            </li>


                            <?php 
                                foreach($_SESSION['user']->__get('friends') as $friend)
                                {
                                    ?>
                                <li class="UserRow"> 
                                    <h2><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></h2>                       
                                    <div class="DayTimeRectangle"></div>

                                    <script src="js/jauge.js"></script>
                                    <script>
                                        
                                        var date = "<?php echo $date->format('Y-m-d'); ?>";
                                        var start_time = "<?php echo $_SESSION[$date->format('Y-m-d')]['start_time']; ?>";
                                        var end_time = "<?php echo $_SESSION[$date->format('Y-m-d')]['end_time']; ?>";
                                        var start_compatibility = 0;
                                        var end_compatibility = 0;

                                        resizeAndColor('08:00:00', '18:00:00', start_compatibility, end_compatibility);
                                    </script>

                                    <div>
                                        <form action='' method="POST" class="RequestCarpoolingIcon">
                                            <input type="hidden" name="" value="">
                                            <input type="image" src="images/request.svg" alt="Carpooling request Icon" id="requestButton" onclick="togglePopup()">
                                        </form>
                                    </div>

                                    
                                        <!-- Content of your popup>
                                        <div class="RequestPopUp" id="RequestPopUp" style="display: none;">
                                            <h1>Demande de covoiturage</h1>
                                            <div class="Informations">
                                                <h2 class="text">Covoitureur : </h2>
                                                <h2 class="text">Date :  </h2>   
                                                <h2 class="text">Mail :</h2>    
                                                <h2 class="text">Téléphone :</h2>  
                                                <div class="checkboxes">
                                                    <label class="text"><input type="checkbox" name="aller_simple" value="aller_simple"> Aller</label>
                                                    <label class="text"><input type="checkbox" name="aller_retour" value="aller_retour"> Retour</label>
                                                </div>   
                                            </div>
                                            <button class="Rectangle Request" type="submit">Envoyer <br/>une demande</button>
                                        </div-->
                                    
                                    <!--<script src="js/popup.js"></script-->

                                </li>
                                    <?php 
                                }
                            ?>
                        </ul>

                    </div>
                    
                    
                </li>
            <?php 
        } ?>

        </ul>
     
    </div>

</body>
</html>