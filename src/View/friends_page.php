<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Amis</title>
  <link rel="stylesheet" href="css/friendspage.css" />
</head>

<?php include "src/View/header_logged.php" ?>

<body>
  <div class="PageFriends">


      <div class="RechercheColumn">
        <form class="Ajouteramis">
          <input type="text" class="AjouterDesAmis" placeholder="Ajouter des amis...">
          <button class="loupeButton" type="submit" onclick="handleButtonClick()">
            <img class="loupe" src="images/loupe.svg" alt="Loupe Icon">
          </button>    
        </form>
        <div class="Nomprenom1">
          <p class="nomprenom1">Nom Prénom</p>
          <button class="PlusButton" onclick="yourFunction()">
            <img class="plusbutton" src="images/plus.svg" >
          </button>
        </div>
      </div>
      <div class="AmisColumns">
        <div class="AmisBar">
            <h1 class="VosAmis">VOS AMIS</h1>
            <button class="EditButton" onclick="handleEditClick()">
              <img src="images/edit1.svg" alt="Edit Icon">
            </button>
        </div>
        <div class="Ami1">
          <p class="ami1">Ami 1</p>
          <button class="MinusButton1" onclick="handleMinusClick()">
            <img class="minus1" src="images/minus.svg" alt="Minus Icon">
          </button>
        </div>
      </div>


  </div>
</body>
</html>
