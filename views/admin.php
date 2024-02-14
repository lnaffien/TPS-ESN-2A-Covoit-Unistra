<!DOCTYPE html>
<html>
<head>
	<title>Page admin</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body class="body2">

	<header class="header">

		<div class="flex justify-between align-center">

			<div class="flex MainPageBtn">

				<img src="images/admin.png" class="main-header-logo ">

				<form action="index.php" method="POST">
					<input type="hidden" name="action" value="homepage">
					<input class="input-mainpage" type="submit" value="Page Principale">
				</form>

			</div>

			<div>
				<h1 class="logo-unistra1"> COVOIT' </h1>
				<h1 class="logo-unistra2"> UNISTRA </h1>
			</div>

			<div>
				<label class="user-logo"> <?php echo $_SESSION["prenom"], ' ', $_SESSION["nom"]?> </label>
			</div>

		</div>
		
	</header>

	<main>

		<form id="form3" action="index.php" method="POST">

			<h1> Section admin :</h1>

			<input type="hidden" name="action" value="delete_users">

			<?php
				// Vérification si la variable $_SESSION['error'] est définie
				if(isset($_SESSION['error'])) 
				{
					echo '<p class="error">' . $_SESSION['error'] . '</p>';
					unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
				}
			?>
			<?php
				foreach ($_SESSION['admin'] as $row) 
				{
					$user_id = $row['idUser'];
					$user_name = $row['nom'] . " " . $row['prenom'];
					$user_email = $row['email'];
			?>

				<div class="barre-separatrice"></div>

				<div class="flex">
					<div class="flex align-center">
					<input type="checkbox" name="user[]" value="<?php echo $user_id; ?>">
					</div>

					<div class="flex-admin">
					<div> <?php echo $user_name; ?> </div>
					<div> <?php echo $user_email; ?> </div>
					</div>
					
				</div>
					
			<?php
				}
			?>

			<div class="barre-separatrice"></div>

			<div class="flex justify-center">

				<input type="submit" value="Supprimer" ><br>

			</div>

		</form>
	</main>

	
</body>

</html>
