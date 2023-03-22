<?php

//session_start();

//$_SESSION["loggedin"] = false;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: level1.php");
    exit;
}

// require_once "DBMain2.php";
require_once "DBMainV3.php";
//require_once "config.php";
require_once "functions.php";

$username_placeholder = "Enter your username";
$password_placeholder = "Enter your password";
// $username = "";
// $password = "";
//$login_err = "";
$dbMain = new ManipulateDB();
$dbMain->username = "";
$dbMain->password = "";
$dbMain->login_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["sign-up"])) {
        header("location: register.php");
        exit;
    }

    // $username = usernameValidation(strtolower(trim($_POST["username"])));

    // $password = passwordValidation(trim($_POST["password"]));

    $dbMain->username = usernameValidation(strtolower(trim($_POST["username"])));

    $dbMain->password = passwordValidation(trim($_POST["password"]));

    $dbMain->loginPlayer();

    //echo "<p>".$dbMain->sqlExec."</p>";
    //echo "<p>".$dbMain->login_err."</p>";




    // // checking if the connection is available
    // if ($connection == TRUE){
    //     // if(empty($username_err) && empty($password_err)){
    //     if(validateNoError()){
    
    //         $sqlCommand = "SELECT id, userName, passCode FROM player JOIN authenticator ON player.registrationOrder = authenticator.registrationOrder WHERE username = '$username'" ;

    //         if($stmt = mysqli_prepare($connection, $sqlCommand)){

    //             // Try to execute the statement
    //             if(mysqli_stmt_execute($stmt)){

    //                 // Get the result for the statement
    //                 mysqli_stmt_store_result($stmt);
                    
    //                 // If the number of rows == 1 the user exist
    //                 if(mysqli_stmt_num_rows($stmt) == 1){  

    //                     // getting the result of the statement and put into the variables
    //                     mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

    //                     // Try to fetch the statment to get the password and check it
    //                     if(mysqli_stmt_fetch($stmt)){
    //                         // Checking that the password match
    //                         if(password_verify($password, $hashed_password)){

    //                             // After confirming the password, we start a new session
    //                             session_start();
                                
    //                             // Creatting $_SESSION variables
    //                             $_SESSION["loggedin"] = true;
    //                             $_SESSION["id"] = $id;
    //                             $_SESSION["username"] = $username;
                                                              
                                
    //                             // Redirect user to welcome page
    //                             header("location: level1.php");
    //                         } else{
    //                             // Password is not valid, display a generic error message
    //                             $login_err = "Invalid username or password.";
    //                         }
    //                     }
    //                 } else{
    //                     // Username doesn't exist, display a generic error message
    //                     $login_err = "Invalid username or password.";
    //                 }
    //             } else{
    //                 echo "Oops! Something went wrong. Please try again later.";
    //             }
    
    //             // Close statement
    //             mysqli_stmt_close($stmt);
    //         }
    //     }
    // }
    
    // // Close connection
    // mysqli_close($connection);
}

?>