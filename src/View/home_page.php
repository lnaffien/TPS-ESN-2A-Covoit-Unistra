<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/popup.css">
    </head>

    <?php include "src/View/header_logged.php";
            require_once "src/Model/Agenda_day.php";
            $id = 0;
            
    ?>
    
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
                $default_time = new DateTime($date->format('Y-m-d') . ' 00:00:00');
                if(!isset($_SESSION[$date->format('Y-m-d')]))
                {
                    $_SESSION[$date->format('Y-m-d')] = new Agenda_day($date, $default_time, $default_time, ""); 
                }
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

                                <div class="DayTimeRectangle" id="<?php echo ++$id?>">                                                        
                                   <!--h3>Start Time: <!?php echo $date->__get_start_time()->format('H:i:s'); ?><--/h3> 
                                   <h3>End Time: <!?php echo $date->__get_end_time()->format('H:i:s'); ?></h3--> 
                                </div>

                                <script src="js/jauge.js"></script>
                                <script>
                                    var date = "<?php echo $date->format('Y-m-d'); ?>";
                                    var start_time = "<?php echo $_SESSION[$date->format('Y-m-d')]->__get('start_time')->format('H:i:s'); ?>";
                                    var end_time = "<?php echo $_SESSION[$date->format('Y-m-d')]->__get('end_time')->format('H:i:s'); ?>";
                                    var start_compatibility = 0;
                                    var end_compatibility = 0;
                                    var id = <?php echo $id; ?>;                                    
                    
                                    resizeAndColor(start_time, end_time, start_compatibility, end_compatibility, id);
                                </script>
                                <div></div>
                            </li>

                            <?php 
                                foreach($_SESSION['user']->__get('friends') as $friend)
                                {
                                    $calendarFull = Agenda_manager::get_full_agenda($friend->__get('nagenda'));
                                    if(!isset($calendarFull[$date->format('Y-m-d')]))
                                    {
                                        $calendarFull[$date->format('Y-m-d')] = new Agenda_day($date, $default_time, $default_time, ""); 
                                    }
                                    require_once("src/Model/Agenda_day.php");?>

                                <li class="UserRow"> 
                                    <h2><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></h2>                       
                                    <div class="DayTimeRectangle" id="<?php echo ++$id?>">  
                                    </div>

                                    <script src="js/jauge.js"></script>
                                    <script>
                                        
                                        var date = "<?php echo $date->format('Y-m-d'); ?>";
                                        var start_time = "<?php echo $calendarFull[$date->format('Y-m-d')]->__get('start_time')->format("H:i:s"); ?>";
                                        var end_time = "<?php echo $calendarFull[$date->format('Y-m-d')]->__get('end_time')->format("H:i:s"); ?>";
                                        var start_compatibility = "<?php echo  $_SESSION[$date->format('Y-m-d')]->compare_start_time_and_place($calendarFull[$date->format('Y-m-d')]); ?>";
                                        var end_compatibility = "<?php echo  $_SESSION[$date->format('Y-m-d')]->compare_end_time_and_place($calendarFull[$date->format('Y-m-d')]); ?>";;
                                        var id = <?php echo $id; ?>;                                       

                                        resizeAndColor(start_time, end_time, start_compatibility, end_compatibility, id);
                                    </script>

                                    <div>
                                        <form action='index.php' method="POST">
                                            <input type="hidden" name="action" value="request">
                                            <input type="hidden" name="friend_id" value="<?php echo $friend->__get('id'); ?>">
                                            <input type="hidden" name="friend_date" value="<?php echo ($date->format('Y-m-d')); ?>">
                                            <input type="hidden" name="friend_name" value="<?php echo $friend->__get('nom') . ' ' . $friend->__get('prenom'); ?>">
                                            <input type="hidden" name="friend_email" value="<?php echo $friend->__get('email'); ?>">
                                            <input type="hidden" name="friend_tel" value="<?php echo $friend->__get('telephone'); ?>">                             
                                            <input type="image" src="images/request.svg" alt="Carpooling request Icon">
                                        </form>
                                    </div>

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