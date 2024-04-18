<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel="stylesheet" href="css/style.css" />
      </head>

     <!-- <?php include "src/View/header_connected.php" ?> -->


<body class="Background">
    <div class="Align_left_center">
        <form id="form" action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="pick_calendar_date">
            <input type="date" value="<?php echo $_SESSION['dateSelectedStart']->format('Y-m-d') ?>" class="CalendarButton">
        </form>
        
        <form action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="reload_calendar_data">
            <input type="image" class="RefreshButton" src="images/refresh.svg" alt="Refresh Icon">
        </form>

        <h1 class="Semaine">Semaine du <?php echo $_SESSION['dateSelectedStart']->format('d/m') ?> au <?php echo $_SESSION['dateSelectedEnd']->format('d/m Y') ?></h1>
    </div>
    
    <ul>
        <li>

            <h1 class="DayLabel">LUNDI</h1>

            <div class="DayRectangle">

                <div class = "Time">
                    <h2>8h30</h2> 
                    <h2>17h30</h2>
                </div> 

                <form action='' method="POST" class="AddUserButton">
                        <input type="hidden" name="" value="">
                        <input type="image" src="images/adduser.svg" alt="Add user Icon">
                    </form>

                <ul>
                    <li class="UserRow"> 
                        <h2><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>                       
                        <div class="DayTimeRectangle"></div>
                    </li>


                    <?php 
                        foreach((array)$_SESSION['user']->__get('friends') as $friend)
                        {
                            ?>
                        <li class="UserRow"> 
                            <h2><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></h2>                       
                            <div class="DayTimeRectangle"></div>

                            <form action='' method="POST" class="RequestCarpoolingIcon">
                                <input type="hidden" name="" value="">
                                <input type="image" src="images/request.svg" alt="Carpooling request Icon">
                            </form>
                        </li>
                            <?php 
                        }
                    ?>
                </ul>

            </div>


            
        </li>

    </ul>
</body>
</html>
