<?php

// Define variables and initialize with empty values


// *****************************  Registration Functions **************************************

$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = "";

// username validation
function usernameValidation($username){
    global $username_err;

    if(empty($username)){        
        $username_err = "Please enter a username !";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }else{
        return strtolower(trim($username));
    }
}

// password validation
function passwordValidation($password){    
    
    global $password_err;
    // Validate password
    if(empty(trim($password))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($password)) < 6){
        $password_err = "Password must have at least 6 characters.";
    }else{
        return $password;
    }    
    
}

// Validate confirm password
function confirmPasswordValidation($password , $confirm_password){

    global $confirm_password_err;    
    
    if(empty(trim($confirm_password))){
        
        $confirm_password_err = "Please confirm password.";     
    } 
    else if (($confirm_password != $password)) {
      
        $confirm_password_err = "Sorry, you entered 2 different passwords.";
               
    }else{
        return $confirm_password;
    }
    
}

// firstname validation
function firstnameValidation($firstname){
    global $firstname_err;

    if(empty(trim($firstname))){        
        $firstname_err = "Please enter a first name.";
    }else{
        return $firstname;
    }
    
}

// lastname validation
function lastnameValidation($lastname){
    
    global $lastname_err;

    if(empty(trim($lastname))){        
        $lastname_err = "Please enter a last name.";
    }else{
        return $lastname;
    }
    
}

// validation no errors
function errorValidation(){
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err))
        return true;
    else
        return false;
   
}

// ************************* Login functions ****************************************

// Declare and initializing variable with empty values
$login_err = "";

/// Validate no username and password error
function validateNoError(){
    
    if(empty($username_err) && empty($password_err))
        return true;
    else
        return false;
}


// ************************* Add below other functions ****************************************

?>
