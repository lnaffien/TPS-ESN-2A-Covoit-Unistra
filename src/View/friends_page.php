<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Amis</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<?php include "src/View/header_logged.php" ?>

<body>

  <form action='index.php' method="POST">
    <input type="hidden" name="action" value="homepage">
    <input type="image" src="images/arrow.svg" alt="Go back arrow Icon"></img> 
  </form>

  <div class="PageFriends">
      <div>
        
        <form action='' method="POST" class='Form_image_end'>
          <input type="hidden" name="" value="">
          <input type="text" placeholder="Ajouter des amis...">
          <input type='image' src="images/loupe.svg" alt="Research Icon" class="loupeButton"/>  
        </form>

        <div class="Text_image_end_bck">
          <p>Nom Prénom</p>
          <form class="" action='' method="POST">
            <input type="hidden" name="" value="">
            <input type='image' src="images/plus.svg" alt="Add Friends Icon"/>  
          </form>
        </div>

      </div>


      <div>

        <div class="Text_image_end">
          <h3>VOS AMIS</h3>
          <form class="" action='' method="POST">
            <input type="hidden" name="" value="">
            <input type='image' src="images/edit1.svg" alt="Edit Friends Icon" class="EditButton"/>  
          </form>      
        </div>

        <ul>
          <?php
            foreach($_SESSION['user']->__get('friends') as $friend)
            {
          ?>
              <li class="Text_image_end_bck"> 
                <p class="ami1"><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></p>                       

                  <form action='' method="POST" >
                      <input type="hidden" name="" value="">
                      <input type="image" src="images/minus.svg" alt="Remove Friend Icon">
                  </form>
                </li>
          <?php 
            }
          ?>
        </ul>

        </div>
      </div>


  </div>
</body>
</html>
