<<<<<<< HEAD:index2.php
<?php

    require('DBMain.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php
        require_once "navBar.php";
    ?>
    <div class="wrapper p-5">
        <?php
        $db = new ManipulateDB();

        $db->createDBandTB();
        ?>
    </div>

    <?php
        require_once "footer.php";
    ?>
</body>
=======
<?php

    require('DBMain.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php
        require_once "navBar.php";
    ?>
    <div class="wrapper p-5">
        <?php
        $db = new ManipulateDB();

        //$db->connectToDB();
        $db->createDBandTB();
        ?>
    </div>

    <?php
        require_once "footer.php";
    ?>
</body>
>>>>>>> f6c8fd5770764a0e37e9ee8d7b90bc700af09076:index.php
</html>