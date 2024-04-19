<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historique</title>
        <link rel="stylesheet" href="../../css/historiquepage.css" />
    </head>
    
    <?php include "src/View/header_logged.php" ?>

    <body>
        <div class="AnnualHistory">        
            <div class="HistoriqueAnnuel">
                <div class="Background">
                    <div class="TitleContainer">
                        <img class="Arrow" src="../../images/arrow.svg" />
                        <h1 class="histotext">Historique annuel</h1>
                    </div> 
                    <div class="Array">    
                        <div class="arrayheader">
                            <div class="Date">
                                <img class="Filter" src="../../images/filter.svg" />
                                <h2 class="DateText">Date</h2>         
                            </div>   
                            <div class="Covoits">
                                <h2 class="Covoitureurs">Covoitureurs</h2>
                            </div>
                        </div> 
                        <div class="Ligne1">
                            <div class="DateColumn">
                                <p class="Ex1annee">26 Mars 2024</p> 
                            </div>
                            <div class="CovoitureursColumn">
                                <p class="Ex1covoitureur">Prénom NOM</p> 
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </body>
</html>
