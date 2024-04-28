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
                            <input type="image" src="images/arrow.svg" alt="GoBackArrowIcon">
                        </form>
                        <h1 class="histotext">Historique</h1>
                    </div>
                    <div class="Array">    
                        <div class="arrayheader">
                            <div class="Date">
                                <img class="Filter" src="images/filter.svg" />
                                <h2 class="DateText">Date</h2>         
                            </div>   
                            <div class="Covoits">
                                <h2 class="Covoitureurs">Covoitureurs</h2>
                            </div>
                        </div> 

                        <div class="Ligne1">
                            <p class="text"> 26 Mars 2024</p>       
                            <p class="text">Prénom NOM</p>
                        </div>
                    </div>  
                </div>
            
        </div>
    </body>
</html>
