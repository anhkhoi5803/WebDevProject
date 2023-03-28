<?php

//require_once "DBMain.php";
require_once "DBMainV3.php";
require_once "functions.php";

session_start();

if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] === true) {
    session_destroy();
    header("location: login.php");
    exit;
}

$answer_placeholder = "Enter your answer";

$dbMain = new ManipulateDB();
$dbMain->username = "";
$dbMain->firstname = "";
$dbMain->lastname = "";
$dbMain->registrationOrder = "";
$dbMain->scoreTime = "";
$dbMain->result = "";
$dbMain->livesUsed = "";

$playerWon = FALSE;
$submitPressed = FALSE;
$gameLevel = 5;
getInstructions();



if($_SERVER["REQUEST_METHOD"] == "POST") {

    if( isset($_POST['sign-out']) ) {
        session_destroy();
        header("location: login.php");
        exit;
    }

    if( isset($_POST['stop_session']) ) {
        if($_SESSION['livesUsed'] > TOTAL_LIVES) {
            $_SESSION['result'] = 'failure';
        }

        $dbMain->username = $_SESSION['username'];
        $dbMain->firstname = $_SESSION['fName'];
        $dbMain->lastname = $_SESSION['lName'];
        $dbMain->registrationOrder = $_SESSION['registrationOrder'];    
        $dbMain->scoreTime = date('Y-m-d H:i:s');
        $dbMain->result = $_SESSION['result'];
        $dbMain->livesUsed = $_SESSION['livesUsed'];

        $dbMain->insertScore();
        
        session_destroy();
        header("location: login.php");
        exit;
    }

    if(isset($_POST["next_level"])) {
        header("location: game6.php");
        exit;
    }

    if(isset($_POST["play_again"])) {
        resetLivesAndDateTimeSession();
        header("location: game1.php");
        exit;
    }

    if(isset($_POST["home_page"])) {
        resetLivesAndDateTimeSession();
        header("location: login.php");
        exit;
    }

    if($_SESSION['livesUsed'] > TOTAL_LIVES) {
        session_destroy();
        header("location: login.php");
        exit;
    }

    if(isset($_POST['send'])) {

        $submitPressed = TRUE;
        $answer = strtolower(trim($_POST['answer']));
        $gameNumLetterString = $_POST['game_num_letters'];
        $gameNumLetterArr = explode(',', $gameNumLetterString);
        if(validateEntryAnswer()) {

            validateCorrectAnswer();

            getResultLevelMsg();

            if(strpos($resultLevelMsg, "Correct")){
                $playerWon = true;

                if(!(in_array($gameLevel, $_SESSION['gainedLevels'], true))) {
                    
                    array_push($_SESSION['gainedLevels'], $gameLevel);

                    echo count($_SESSION['gainedLevels']);

                    if(count($_SESSION['gainedLevels']) == TOTAL_LEVELS){
                        
                        $_SESSION['result'] = 'success';

                        $dbMain->username = $_SESSION['username'];
                        $dbMain->firstname = $_SESSION['fName'];
                        $dbMain->lastname = $_SESSION['lName'];
                        $dbMain->registrationOrder = $_SESSION['registrationOrder'];
                        $dbMain->scoreTime = date('Y-m-d H:i:s');
                        $dbMain->result = $_SESSION['result'];
                        $dbMain->livesUsed = $_SESSION['livesUsed'];

                        $resultLevelMsg = $resultLevelMsg . '<br/><br/>Congratulations!! You have won all the ' . TOTAL_LEVELS . ' levels!';

                        $dbMain->insertScore();
                    }
                }
            }else {

                if($_SESSION['livesUsed'] >= TOTAL_LIVES) {
                    $_SESSION['result'] = 'failure';

                    $dbMain->username = $_SESSION['username'];
                    $dbMain->firstname = $_SESSION['fName'];
                    $dbMain->lastname = $_SESSION['lName'];
                    $dbMain->registrationOrder = $_SESSION['registrationOrder'];    
                    $dbMain->scoreTime = date('Y-m-d H:i:s');
                    $dbMain->result = $_SESSION['result'];
                    $dbMain->livesUsed = $_SESSION['livesUsed'];

                    $resultLevelMsg = $resultLevelMsg . '<br/><br/>Well Played. Try again later!! You have used all the ' . TOTAL_LIVES . ' lives!';

                    $dbMain->insertScore();

                    $_SESSION['livesUsed'] = $_SESSION['livesUsed'] + 1;

                } else {
                    $_SESSION['livesUsed'] = $_SESSION['livesUsed'] + 1;
                }

            }
        }

    }else {
        generateNumbersLetters();
    }

} else {
    generateNumbersLetters();


}

?>

<?php
    // if(isset($_POST['send'])){
    //     $min = $_POST['minNum'];
    //     $max = $_POST['maxNum'];
    //     $arr = $_SESSION['arr'];
    //     if(getError())
    //         checkNums();
    //     }
    // function generateRandomNums(&$arr){
    //     $temp = rand(0,100);
    //     if(in_array($temp,$arr)){
    //         generateRandomNums($arr);
    //     }
    //     else{
    //         array_push($arr,$temp);
    //     }
    // }
    // if(!isset($_POST['send'])){
    //     session_start();
    //         $_SESSION['arr'] =array();
    //         if(count($_SESSION['arr'])===0){
    //             $array = array();
    
    //             for($i = 0;$i<6;$i++){
    //                 generateRandomNums($array);
    //             }
    //             $_SESSION['arr']= $array;
    //         }
    //     }
    
    
    // function getError(){
    //     global $min;
    //     global $max;
    //     global $arr;

    //     if(!in_array($min,$arr)and !in_array($max,$arr) ){
    //         echo "Both the number you entered is not in the array";
    //         return false;
    //     }
    //     elseif (!in_array($min,$arr) || !in_array($max,$arr)) {
    //         echo "One of the number you entered is not in the array";
    //         return false;
    //     }
    //     else{
    //         echo "Both the number you entered is in the array";
    //         return true;
    //     }

    // }

    // function checkNums(){
    //     global $min;
    //     global $max;
    //     global $arr;

    //     if($max === max($arr) && $min === min($arr)){
    //         echo "Both the maximum and minimum you entered is right";
    //         return true;
    //     }
    //     elseif ($max !== max($arr) && $min === min($arr)) {
    //         echo "The minimum you entered is right";
    //         return false;

    //     }
    //     elseif ($max === max($arr) && $min !== min($arr)) {
    //         echo "The maximum you entered is right";
    //         return false;

    //     }
    //     else{
    //         echo "Both the maximum and minimum you entered is wrong";
    //         return false;

    //     }
    // }



?>