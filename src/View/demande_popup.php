<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/popups.css" />
</head>

<?php include "src/View/header_logged.php" ?>

<body>
<form id="form" action="" method="POST">
  <input type="hidden" name="action_request_covoit" value="request_covoit">

  <div class="RequestPopUp">
    <div class="TitleContainer">
        <form action='index.php' method="POST">
            <input type="hidden" name="action" value="homepage">
            <input type="image" class="arrow" src="images/arrow.svg" alt="GoBackArrowIcon">
        </form>
        <h1>Demande de covoiturage</h1>
    </div>

      <div class="Informations">
          <h2 class="text">Covoitureur : <?php echo $friendName; ?></h2>
          <h2 class="text">Date :  <?php echo $friendDate; ?> </h2>   
          <h2 class="text">Mail :<?php echo $friendEmail; ?></h2>    
          <h2 class="text">Téléphone :<?php echo $friendTel; ?></h2>  
          <div class="checkboxes">
            <label class="text"><input type="checkbox" name="aller_simple" value="aller_simple"> Aller</label>
            <label class="text"><input type="checkbox" name="aller_retour" value="aller_retour"> Retour</label>
          </div>   
      </div>
    
      <button class="Rectangle Request" type="submit">Envoyer <br/>une demande</button>
</div>

</form>
</body>
</html>