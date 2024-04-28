<!DOCTYPE html>
<html>

<head>  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css/style.css" />
</head>

<header>

    <form action='index.php' method="POST">
        <input type="hidden" name="action" value="homepage">
        <h1>
            <input type='submit' value="COVOIT’ UNISTRA">
        </h1>
    </form>
    
    <div>
        <h2><?php print_r($_SESSION['user']->__get('nom') . ' ' . $_SESSION['user']->__get('prenom'));?></h2>  

        <form action='index.php' method="POST">
            <input type="hidden" name="action" value="notification">
            <input type='image' src="images/notification.svg" alt="Bell Icon"/>
        </form>

        <form action='index.php' method="POST">
            <input type="hidden" name="action" value="friend">
            <input type='image' src="images/friends.svg" alt="Friends Icon"/>
        </form>

        <form action='index.php' method="POST">
            <input type="hidden" name="action" value="settings">
            <input type="image" src="images/profileuser.svg" alt="User profile Icon">
        </form>
    </div>

</header>
</html>

