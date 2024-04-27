<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../../css/popups.css" />
</head>

<form action="index.php" method="POST">
  <input type="hidden" name="action" value="request_covoit">

  <div class="RequestPopUp">

    <h1>Demande de covoiturage</h1>

    <div class="Informations">
        <h2 class="text">Covoitureur : </h2>
        <h2 class="text">Date :  </h2>   
        <h2 class="text">Mail :</h2>    
        <h2 class="text">Téléphone :</h2>  
        <div class="checkboxes">
          <label class="text"><input type="checkbox" name="aller_simple" value="aller_simple"> Aller</label>
          <label class="text"><input type="checkbox" name="aller_retour" value="aller_retour"> Retour</label>
        </div>   
    </div>
  
    <button class="Rectangle Request" type="submit">Envoyer <br/>une demande</button>
</div>

</form>
</html>