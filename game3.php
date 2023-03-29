<!-- 
Thiago Soares de Souza
Web Server Applications
26 March 2023
LaSalle College
Web Server Project - Game 3 Form
-->

<?php

require_once "game3Controller.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Leve <?php echo $gameLevel; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
</head>
<body>
    <?php
        //require_once "header.php";
        require_once "navBar.php";
    ?>
    <div class="wrapper p-5">
        <h2>Game Level <?php echo $gameLevel . ":"; ?> <?php echo $instructions; ?></h2>
        <!--
        <h2 class="is-valid">Game Level <?php //echo $gameLevel . ":"; ?> <?php //echo $instructions; ?></h2>
        <span class="valid-feedback"><?php //echo (isset($_SESSION['loggedin']) && (in_array(($gameLevel), $_SESSION['gainedLevels'], true))) ? 'You Have Already Won This Level (Any mistake will not decrease your lives)' : '';?></span>
        -->
        <p>Please <?php echo $instructions; ?> (from 0 to 100).</p>
        <p>** put ',' between the numbers (Example: 0,1,2,3,4,5).</p>

        <?php 

        if(!empty($answer_err)){
            echo '<div class="alert alert-danger">' . $answer_err . '</div>';
        }        
        ?>

        <form name="sign-in" action="game3.php" method="post">
            <div class="form-group">
                <label for="">Game Numbers</label>
                <input type="text" name="game_num_letters" class="form-control read-only" readonly value="<?php echo $gameNumLetterString; ?>">
                <label for="answer_num">Answer</label>
                <input type="text" name="answer" id="answer_num" class="form-control <?php echo (!empty($answer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer; ?>" placeholder="<?php echo $answer_placeholder; ?>">
                <span class="invalid-feedback"><?php echo $answer_err; ?></span>

                <?php 
                if(!empty($resultLevelMsg)){
                    if(strpos($resultLevelMsg, "Correct") || strpos($resultLevelMsg, "Congratulations")){
                        echo '<div class="alert alert-success">' . $resultLevelMsg . '</div>';
                    }else {
                        echo '<div class="alert alert-danger">' . $resultLevelMsg . '</div>';
                    }
                }
                ?>

            </div>    
            <div class="form-group">
                <?php
                    if (!$submitPressed || !empty($answer_err)) {
                        echo <<<_NOTSUBMIT
                            <!--<input type="submit" class="btn btn-primary" value="Previous Level" name="previous_level">-->
                            <input type="submit" class="btn btn-primary" value="Submit Answer" name="send">
                            <input type="submit" class="btn btn-primary" value="Sign-Out" name="sign-out">

                        _NOTSUBMIT;
                        // if(isset($_SESSION['loggedin']) && (in_array(($gameLevel), $_SESSION['gainedLevels'], true))) {
                        //     echo '<input type="submit" class="btn btn-primary" value="Next Level" name="next_level">';
                        // }
                    } else {

                        //if(count($_SESSION['gainedLevels']) == TOTAL_LEVELS || $_SESSION['livesUsed'] > TOTAL_LIVES) {
                        if($_SESSION['livesUsed'] > TOTAL_LIVES) {
                            echo <<<_GAMEOVER
                            //echo <<<_WON_GAMEOVER
                            <input type="submit" class="btn btn-primary" value="Home Page" name="home_page">
                            <input type="submit" class="btn btn-primary" value="Play Again" name="play_again">
                            <input type="submit" class="btn btn-primary" value="Sign-Out" name="sign-out">

                            _GAMEOVER;
                            //_WON_GAMEOVER;
                        } else {
                            echo <<<_SUBMIT
                            <!--<input type="submit" class="btn btn-primary" value="Previous Level" name="previous_level">-->
                            <input type="submit" class="btn btn-primary" value="Sign-Out" name="sign-out">
                            <input type="submit" class="btn btn-primary" value="Stop this Session" name="stop_session">

                            _SUBMIT;

                            //if (!$playerWon || (in_array(($gameLevel), $_SESSION['gainedLevels'], true))) {
                            if (!$playerWon) {
                                echo <<<_NOTWON
                                <input type="submit" class="btn btn-primary" value="Try Again this Level" name="try_again">

                                _NOTWON;
                            } else {
                                echo <<<_WON
                                <input type="submit" class="btn btn-primary" value="Go the Next Level" name="next_level">

                                _WON;
                            }

                            // if(isset($_SESSION['loggedin']) && (in_array(($gameLevel), $_SESSION['gainedLevels'], true))) {
                            //     echo '<input type="submit" class="btn btn-primary" value="Next Level" name="next_level">';
                            // }

                        }
                        
                    }
                ?>
            </div>
        </form>
    </div>

    <?php
        require_once "footer.php";
    ?>
</body>
</html>