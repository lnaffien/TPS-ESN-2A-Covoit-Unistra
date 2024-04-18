<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/style.css" />
</head>

<header>

    <form action='index.php' method="POST" class="CovoitButton">
        <input type="hidden" name="action" value="homepage">
        <h2>
            <input type='submit' value="COVOIT’ UNISTRA" class="CovoitButton">
        </h2>
    </form>

    <h2><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>  

    <form action='index.php' method="POST">
        <input type="hidden" name="action" value="friend">
        <input type='image' src="images/friends.svg" alt="Friends Icon"/>
    </form>

    <form action='index.php' method="POST">
        <input type="hidden" name="action" value="user_profile">
        <input type="image" src="images/profileuser.svg" alt="User profile Icon">
    </form>

</header>
</html>

