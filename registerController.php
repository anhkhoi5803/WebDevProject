
<!-- 
Ronald Mercado H.
Web Server Applications
11 March 2023
LaSalle College
Web Server Project - Registration Form - Process
-->

<?php

// Include config and functions files

require_once "functions.php";
require_once "ConnectionDB.php";

class Register {
    //Attributes
    private $fName;
    private $lName;
    private $userName;
    private $password;
    //private $registrationOrder;
    private $db;

    // Constructor
    public function __construct($fName, $lName, $userName, $password) {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->userName = $userName;
        $this->password = $password;
        //$this->registrationOrder = $registrationOrder;
        $this->db = new ManipulateDB();
    }

    //Getter - Setters
    public function getFName() {
        return $this->fName;
    }
    public function setFName($fName) {
        $this->fName = $fName;
    }
    public function getLName() {
        return $this->lName;
    }
    public function setLName($lName) {
        $this->lName = $lName;
    }
    public function getUserName() {
        return $this->userName;
    }
    public function setUserName($userName) {
        $this->userName = $userName;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getRegistrationOrder() {
        return $this->registrationOrder;
    }
    public function setRegistrationOrder($registrationOrder) {
        $this->registrationOrder = $registrationOrder;
    }

    // Register a new player
    public function registerPlayer() {
        
        $sql1 = "INSERT INTO player (fName, lName, userName) VALUES ('$this->fName', '$this->lName', '$this->userName')";
        
        
        $sql2 = "SELECT registrationOrder FROM player WHERE userName = ?";
        
        


        $sql3 = "INSERT INTO authenticator (passCode, registrationOrder ) VALUES ('$this->password', '$registrationOrder')";
        
        $sql = $sql1 . ";" . $sql2 . ";" . $sql3;

        if (mysqli_multi_query($this->db->getConnection(), $sql))
        {
            echo "Records inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($this->db->getConnection());
        }
    }
}


$username = $password = $confirm_password = $firstname = $lastname =  "";

//if(isset($_POST['send'])){
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // validations
    $username = usernameValidation($_POST['username']);   
    $password = passwordValidation($_POST['password']);    
    $confirm_password = confirmPasswordValidation($_POST['password'], $_POST['confirm_password']);    
    $firstname = firstnameValidation($_POST['firstname']);    
    $lastname = lastnameValidation($_POST['lastname']);
    $errorValidation = errorValidation();

    // Create a new instance of the DatabaseManager class 
    $newPlayer = new Register($firstname, $lastname, $username, $password, 1 );
    // Insert player data into the database
    $newPlayer->registerPlayer();
    
}

?>