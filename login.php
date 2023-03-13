<!-- 
Thiago Soares de Souza
Web Server Applications
12 March 2023
LaSalle College
Web Server Project - Login Form
-->

<?php

session_start();

//$_SESSION["loggedin"] = false;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: level1.php");
    exit;
}


require_once "config.php";

//require_once "process.php";
require_once "functions.php";

$username_placeholder = "Enter your username";
$password_placeholder = "Enter your password";
$username = "";
$password = "";
$username_err = "";
$password_err = "";
$login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["sign-up"])) {
        header("location: register.php");
        exit;
    }

    //usernameValidation($username);

    //passwordValidation($password);

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = 'SELECT id, userName, passCode FROM player JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder WHERE username = ?';
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: level1.php");
                            // echo '<script type="text/javascript">
                            //         window.location = "register.php"
                            //     </script>';
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connection);
}



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
        //require_once "header.php";
        require_once "navBar.php";
    ?>
    <div class="wrapper p-5">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <!-- <form action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?><!--" method="post"> -->
        <form name="sign-in" action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="<?php echo $username_placeholder; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $password_placeholder; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Connect" name="connect">   
                <input type="submit" class="btn btn-primary" value="Sign-Up" name="sign-up" onclick="sign-in.action='register.php'" >
            </div>
            <?php 
            if(!empty($login_err)){
                echo '<p>Forgotten? Please, <a href="passwordModification.php">change your password</a>.</p>';
            }        
            ?>
        </form>
    </div>

    <?php
        require_once "footer.php";
    ?>
    <!--
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Authors: Ronald, Anh Khoi and Thiago<br> -->
            <!-- Copyright -->
       <!--     © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer> -->
</body>
</html>