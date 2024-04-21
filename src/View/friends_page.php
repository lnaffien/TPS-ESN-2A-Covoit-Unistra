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

      <!-- Search user part -->
      <div>
        
        <form action='index.php' method="POST" class='Form_image_end'>          
          <input type="hidden" name="action" value="friend">
          <input type="hidden" name="friend_page_click" value="search_user">
          <input type="text" name="search" placeholder="Ajouter des amis...">
          <input type='image' src="images/loupe.svg" alt="Research Icon" class="loupeButton"/>  
        </form>

        <?php
        if(isset($_SESSION['search_users']))
        {
          foreach($_SESSION['search_users'] as $searched_user)
          {
        ?>
          <div class="Text_image_end_bck">
            <p>
              <?php 
                print_r($searched_user['nom']);
                print_r(" ");
                print_r($searched_user['prenom'])
              ?>
            </p>
            <form action='index.php' method="POST">
              <input type="hidden" name="action" value="friend">
              <input type="hidden" name="friend_page_click" value="add_friend">
              <?php echo "<input type='hidden' name='friend_id' value='" . $searched_user['idUser'] . "'>" ?>             
              <input type='image' src="images/plus.svg" alt="Add Friends Icon"/>  
            </form>
          </div>
        <?php
          }
        }
        ?>
        
      </div>

      <!-- Manage friends part -->
      <div>

        <div class="Text_image_end">
          <h3>VOS AMIS</h3>
          <form action='index.php' method="POST">
            <input type="hidden" name="action" value="friend">
            <input type="hidden" name="friend_page_click" value="remove_friend_btn">
            <input type='image' src="images/edit1.svg" alt="Edit Friends Icon" class="EditButton"/>  
          </form>      
        </div>

        <ul>
          <?php
            foreach($_SESSION['user']->__get('friends') as $friend)
            {
          ?>
              <li class="Text_image_end_bck"> 
                <p><?php print_r($friend->__get('nom') . ' ' . $friend->__get('prenom'));?></p>                       

                  <form action='index.php' method="POST" >
                    <input type="hidden" name="action" value="friend">
                    <input type="hidden" name="friend_page_click" value="remove_friend">
                    <?php echo "<input type='hidden' name='friend_id' value='" . $friend->__get('id') . "'>" ;
                      if($_SESSION['remove_friend_btn'])
                      {
                        echo '<input type="image" src="images/minus.svg" alt="Remove Friend Icon">';
                      }
                    ?>                        
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
