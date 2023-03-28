<?php
    require_once "DBMainV3.php";
    require_once "functions.php";

    session_start();

    if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] === true) {
        session_dest();
    }

    $answer_placeholder = "Enter your answer";

    $dbMain = new ManipulateDB(); 
    $playerWon = FALSE;
    $submitPressed = FALSE;
    $gameLevel = 1;
    getInstructions();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if( isset($_POST['sign-out']) ) {
            session_dest();
        }        

        if( isset($_POST['stop_session']) ) {
            if($_SESSION['livesUsed'] > TOTAL_LIVES) {
                $_SESSION['result'] = 'failure';
            }
            setData($dbMain);
            $dbMain->insertScore();        
            session_dest();
            
        }

        if(isset($_POST["next_level"])) {
            header("location: game2.php");
            exit;
        }

        if(isset($_POST["play_again"])) {
            resetLivesAndDateTimeSession();
            header("location: game1.php");
            exit;
        }

        if(isset($_POST["home_page"])) {
            resetLivesAndDateTimeSession();
            header("location: login2.php");
            exit;
        }

        if($_SESSION['livesUsed'] > TOTAL_LIVES) {
            session_dest();
        }

        // game Start
        if(isset($_POST['send'])){

            $submitPressed = TRUE;
            $answer = strtolower(trim($_POST['answer']));
            $gameNumLetterString = $_POST['game_num_letters'];
            
            $gameNumLetterArr = explode(',', $gameNumLetterString);

            if(validateEntryAnswer()) {
                validateCorrectAnswer();
                getResultLevelMsg2();

                if(strpos($resultLevelMsg, "Correct")){
                    $playerWon = true;

                    if(!(in_array($gameLevel, $_SESSION['gainedLevels'], true))) {                        
                        array_push($_SESSION['gainedLevels'], $gameLevel);
                        echo count($_SESSION['gainedLevels']);
                        if(count($_SESSION['gainedLevels']) == TOTAL_LEVELS){                            
                            $_SESSION['result'] = 'success';
                            setData($dbMain);
                            $resultLevelMsg = $resultLevelMsg . '<br/><br/>Congratulations!! You have won all the ' . TOTAL_LEVELS . ' levels!';
                            $dbMain->insertScore();
                        }
                    }
                }else {
                    if($_SESSION['livesUsed'] >= TOTAL_LIVES) {
                        $_SESSION['result'] = 'failure';
                        setData($dbMain);
                        $resultLevelMsg = $resultLevelMsg . '<br/><br/>Well Played. Try again later!! You have used all the ' . TOTAL_LIVES . ' lives!';
                        $dbMain->insertScore();
                        $_SESSION['livesUsed'] = $_SESSION['livesUsed'] + 1;
                    } else {
                        $_SESSION['livesUsed'] = $_SESSION['livesUsed'] + 1;
                    }
                }
            }
        }else {generateNumbersLetters();}

    } else {generateNumbersLetters();}

?>