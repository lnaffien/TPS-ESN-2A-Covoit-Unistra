<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/notificationspage.css" />
</head>
<body>
    <?php include "src/View/header_logged.php" ?>

    <div class="Notifications">
        <div class="Background">
            <div class="TitleContainer">
                <form action='index.php' method="POST">
                    <input type="hidden" name="action" value="homepage">
                    <input type="image" src="images/arrow.svg" alt="GoBackArrowIcon">
                </form>
                <h1 class="histotext">Notifications</h1>
            </div>

            <?php

            foreach ($awaitingRequests as $request) {
                echo "<div class='Row'>";
                echo "<p class='text'>" . $request['dateCovoiturage'] . "</p>";
                echo "<p class='text'>" . $request['nom'] . " " . $request['prenom'] . "</p>";
                echo "<p class='text'>" . ($request['aller'] && $request['retour'] ? "ALLER/<br/>RETOUR" : ($request['aller'] ? "ALLER SIMPLE" : "RETOUR SIMPLE")) . "</p>";
                echo "<div class='Icons'>";
                echo "<form  method='POST'>";
                    echo "<input type='hidden' name='request_id1' value='" . $request['idCovoiturage'] . "'>";
                    echo "<input type='hidden' name='action_accept_covoit' value='acceptCovoit'>";
                    echo "<input type='image' src='images/accept.svg' alt='accepticon'>";
                echo "</form>";
                echo "<form method='POST'>";
                    echo "<input type='hidden' name='request_id2' value='" . $request['idCovoiturage'] . "'>";
                    echo "<input type='hidden' name='action_reject_covoit' value='rejectCovoit'>";
                    echo "<input type='image' src='images/cancel.svg' alt='rejecticon'>";
                echo "</form>";
                echo "</div>"; // Icons
                echo "</div>"; // Row
            }
            ?>

        </div>      
    </div>    
</body>
</html>
