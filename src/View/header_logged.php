<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/editdata.css" />
</head>

<header class="HeaderLoggedIn">

    <h2 class="PrenomNom"><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>  


    <form id="form" action='index.php' method="POST" class="UserButton">
        <input type="hidden" name="action" value="user_profile">
        <input type="image" src="images/profileuser.svg" alt="User profile Icon">
    </form>
    
    <form id="form" action='index.php' method="POST">
        <input type="hidden" name="action" value="friend">
        <input type='image' class="FriendsButton" src="images/friends.svg" alt="Friends Icon"/>
    </form>

    <form id="form" action='index.php' method="POST" class="CovoitUnistra">
        <input type="hidden" name="action" value="homepage">
        <h2 class="CovoitButton">
            <input type='submit' value="COVOIT’ UNISTRA" class="CovoitButton">
        </h2>

    </form>

</header>
</html>

