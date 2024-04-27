<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notifications</title>
        <link rel="stylesheet" href="css/notificationspage.css" />
    </head>
    
    <?php include "src/View/header_logged.php" ?>

    <body>

        <div class="Notifications">
        <div class="Background">
            <div class="TitleContainer">
                <form action='index.php' method="POST">
                    <input type="hidden" name="action" value="homepage">
                    <input type="image" src="images/arrow.svg" alt="GoBackArrowIcon">
                </form>
                <h1 class="histotext">Notifications</h1>
            </div>

            <div class="Row">
                <p class="text"> 26 Mars 2024</p>       
                <p class="text">Prénom NOM</p>
                <p class="text">Aller Simple</p>
                <div class="Icons">
                <form action='index.php' method="POST">
                    <input type="hidden" name="action" value="acceptCovoit">
                    <input type="image" src="images/accept.svg" alt="accepticon">
                </form>
                <form action='index.php' method="POST">
                    <input type="hidden" name="action" value="rejectCovoit">
                    <input type="image" src="images/cancel.svg" alt="rejecticon">
                </form>
            </div>

            </div>
        </div>
    </div>

  </body>
</html>
