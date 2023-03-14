
<?php

require_once "functions.php";

$username = $password = $confirm_password = $firstname = $lastname =  "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $username = $_POST['username'];    
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
   
    
    // validations
    $username = usernameValidation($username);   
    $password = passwordValidation($password);    
    $confirm_password = confirmPasswordValidation($password, $confirm_password);    
   
    $errorValidation = errorValidation();
}

?>