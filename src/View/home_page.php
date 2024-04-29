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

        <h1 class="Semaine">Semaine du <?php echo $_SESSION['dateSelected']['start']->format('d/m') ?> au <?php echo $_SESSION['dateSelected']['end']->format('d/m Y') ?></h1>
    </div>
    
    <ul>

        <?php
        foreach($_SESSION['dateSelected']['period'] as $date)
            {
                print_r("<br/>");

            ?>
             <li>

                <h1 class="DayLabel"><?php print_r($date->format('l')) ?></h1>

                    <div class="DayRectangle">

                        <div class = "Time">
                            <h2>8h30</h2> 
                            <h2>17h30</h2>
                        </div> 

                        <ul>
                            
                            <li class="UserRow"> 
                                <h2><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>                     
                                 <!--?php
                                    //require_once 'src/Model/Agenda_manager.php';
                                ?-->                              
                                                      
                                <div class="DayTimeRectangle">                             
                                   <!--h3>Start Time: <!?php echo $date->__get_start_time()->format('H:i:s'); ?><--/h3> 
                                   <h3>End Time: <!?php echo $date->__get_end_time()->format('H:i:s'); ?></h3--> 
                                </div>
                            </li>

                            <?php 
                                foreach($_SESSION['user']->__get('friends') as $friend)
                                {
                                    ?>
                                <li class="UserRow"> 
                                    <h2><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></h2>                       
                                    <div class="DayTimeRectangle"></div>
                                 
                                    <form action='index.php' method="POST">
                                        <input type="hidden" name="action" value="request">
                                        <input type="hidden" name="friend_id" value="<?php echo $friend->__get('id'); ?>">
                                        <input type="hidden" name="friend_date" value="<?php echo ($date->format('Y-m-d')); ?>">
                                        <input type="hidden" name="friend_name" value="<?php echo $friend->__get('nom') . ' ' . $friend->__get('prenom'); ?>">
                                        <input type="hidden" name="friend_email" value="<?php echo $friend->__get('email'); ?>">
                                        <input type="hidden" name="friend_tel" value="<?php echo $friend->__get('telephone'); ?>">                             
                                        <input type="image" src="images/request.svg" alt="Carpooling request Icon">
                                    </form>
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