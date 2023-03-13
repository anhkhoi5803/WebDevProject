
<!-- 
Ronald Mercado H.
Web Server Applications
11 March 2023
LaSalle College
Web Server Project - Registration Form - Process
-->

<?php

// Include config and functions files
require_once "config.php";
require_once "functions.php";

$username = $password = $confirm_password = $firstname = $lastname =  "";

//if(isset($_POST['send'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $username = $_POST['username'];    
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    
    // validations
    $username = usernameValidation($username);   
    $password = passwordValidation($password);    
    $confirm_password = confirmPasswordValidation($password, $confirm_password);    
    $firstname = firstnameValidation($firstname);    
    $lastname = lastnameValidation($lastname);

    $errorValidation = errorValidation();


    $sql1 = "INSERT INTO player (fName, lName, userName) VALUES ('$firstname', '$lastname', '$username')";    
    $sql2 = "INSERT INTO authenticator (passCode, registrationOrder) VALUES ('$password', 'registrationOrder')";
    $sql = $sql1 . ";" . $sql2;

    // Check conection
    if($link === false){
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
        
    }else{
        if ($errorValidation === true) {
            
            if(mysqli_multi_query($link, $sql)){
                echo "Records inserted successfully.<\br>";
                echo $errorValidation;
            }
        }
        // Close connection
        mysqli_close($link);
    }     
    
}

?>