<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/style.css" />
</head>

<?php include "src/View/header_logged.php" ?>

<body>
    <div class="Background">
      
      <div class="TitleContainer">
        <form action='index.php' method="POST">
            <input type="hidden" name="action" value="homepage">
            <input type="image" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
        </form>
        <h1>Demande de covoiturage</h1> 
      </div>

      <form action="" method="POST">
        <input type="hidden" name="action_request_covoit" value="request_covoit">
        <input type="hidden" name="friend_id" value="<?php echo $friendId; ?>">
        <input type="hidden" name="friend_date" value="<?php echo $friendDate; ?>">

      <div class="Informations">
          <h2 class="text">Covoitureur : <?php echo $friendName; ?></h2>
          <h2 class="text">Date :  <?php echo $friendDate; ?> </h2>   
          <h2 class="text">Mail :<?php echo $friendEmail; ?></h2>    
          <h2 class="text">Téléphone :<?php echo $friendTel; ?></h2>  
          <div class="checkboxes">
              <input type="checkbox" name="aller" value="1">              
              <label> Aller</label>
              <input type="checkbox" name="retour" value="1">
              <label> Retour</label>
          </div> 
      </div>
    
      <button type="submit">Envoyer <br/>une demande</button>
</form>
</div>
</body>

</html>