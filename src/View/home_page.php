<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel="stylesheet" href="css/homepage.css" />
    </head>

    <?php include "src/View/header_connected.php" ?>

<body>
    <div class="HomePage">



        <form id="form" action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="reload_calendar_data">
            <input type="image" class="RefreshButton" src="images/refresh.svg" alt="Refresh Icon">
        </form>

        <form id="form" action='src/View-Model/Home_ViewModel.php' method="POST">
            <input type="hidden" name="home_page_click" value="pick_calendar_date">
            <input type="date" value="<?php echo $_SESSION['dateSelectedStart']->format('Y-m-d') ?>" class="CalendarButton">
        </form>

        </button>
        <h1 class="Semaine">Semaine du <?php echo $_SESSION['dateSelectedStart']->format('d/m') ?> au <?php echo $_SESSION['dateSelectedEnd']->format('d/m Y') ?></h1>
      
        <ul class="Week">
            <li>
                <div class="Lundi">
                    <div class="DayLabel">
                        <h1 class="lundilabel">LUNDI</h1>
                    </div> 

                    <div class="LundiConcordance">
                        <div class="Rectanglelundi"></div>

                        <form action='' method="POST" class="AddUserButton">
                            <input type="hidden" name="" value="">
                            <input type="image" class="addusericon" src="images/adduser.svg" alt="Add user Icon">
                        </form>

                        <h2 class="debutlundi">17h30</h2>
                        <h2 class="finlundi">8h30</h2>   

                        <ul class="Ami">
                            <li class="Moirow">
                                <div class="Rectangle6"></div>
                                <h2 class="Moi">Moi</h2>
                            </li>

                            <li>
                                <div class="Ami1row">
                                    <div class="Rectangle4"></div>
                                    <h2 class="Ami1">Ami1</h2>
                                    
                                    <form action='' method="POST" class="RequestButton2">
                                        <input type="hidden" name="" value="">
                                        <input type="image" class="requesticon2" src="images/request.svg" alt="Carpooling request Icon">
                                    </form>
                                </div>
                            </li>
                        </ul> 

                    </div>

                </div>
            </li>

        </ul>
     
    </div>
</body>
</html>
