<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historique</title>
        <link rel="stylesheet" href="css/historiquepage.css" />
    </head>
    
    <?php include "src/View/header_logged.php" ?>

    <body>
        <div class="AnnualHistory">             
                <div class="Background">
                    <div class="TitleContainer">
                        <form action='index.php' method="POST">
                            <input type="hidden" name="action" value="homepage">
                            <input type="image" class="arrowicon" src="images/arrow.svg" alt="GoBackArrowIcon">
                        </form>
                        <h1 class="histotext">Historique</h1>
                    </div>
                    <div class="Array">    
                        <div class="arrayheader">                     
                                <h2 class="Covoitureurs">Date</h2>                                                       
                                <h2 class="Covoitureurs">Covoitureurs</h2>
                        </div> 
                        <?php
                            foreach ($acceptedRequests as $request) {
                                echo "<div class='Ligne1'>";
                                echo "<p class='text'>" . $request['dateCovoiturage'] . "</p>";
                                echo "<p class='text'>" . $request['nom'] . " " . $request['prenom'] . "</p>";
                                echo "</div>";
                            }
                        ?>
                    </div>  
                </div>
            
        </div>
    </body>
</html>

