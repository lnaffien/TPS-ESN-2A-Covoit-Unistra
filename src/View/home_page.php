<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <title> Page principale </title>

</head>

<body class="body1" >

    <main>

        <section>

            <form action="index.php" method="POST">

                <div class="flex justify-center">

                    <input type="search" name="BarreR" placeholder="Recherche..." class="BarreR" value=<?php echo $_SESSION['userSelected'];?>>

                </div>
                <div class="flex align-center justify-between">

                    <div class="align-date">

                        <input class="input_date" id="inputDate" type="date" name="date" value=<?php echo $_SESSION['dateSelected'];?>>

                    </div>

                    <div>

                        <input type="hidden" name="action" value="homepage_filters">
                        <input class="input-barre-date" type="submit" value="MàJ" >

                    </div>

                </div>

            </form>

        </section>

        <section>

            <form id="form1">
               
            </form>
        </section>
    </main>
</body>




</html>
