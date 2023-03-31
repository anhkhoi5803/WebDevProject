<?php

require "game5Controller.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Leve 5</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php
        //require_once "header.php";
        require_once "navBar.php";
    ?>
    <div class="content">
        <div class="content__container">
        <h2 class="content__heading"> <span>Game Level 5</span>: <?php echo $instructions; ?></h2>
        <p class="content__desc"">Please <?php echo $instructions; ?> (from a to z).</p>
        <p class="content__desc">** put ',' between the letters (Example: a,b,c,d,e).</p>
        <p class="content__desc">** put the first letter before the latter letter (Example: a,z).</p>
        </div>

        <?php 

        if(!empty($answer_err)){
            echo '<div class="alert alert-danger">' . $answer_err . '</div>';
        }        
        ?>

        <form name="sign-in" action="game5.php" method="post">
            <div class="form-group">
                <label class="content__desc" for="answer">Answer</label>
                <input type="text" name="answer" id="answer" class="form-control <?php echo (!empty($answer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $answer; ?>" placeholder="<?php echo $answer_placeholder; ?>">
                <span class="invalid-feedback"><?php echo $answer_err; ?></span>
                <label for="">Game Numbers</label>
                <input type="text" name="game_num_letters" class="form-control read-only" readonly value="<?php echo $gameNumLetterString; ?>">

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
                            <input type="submit" class="game_btn" value="Submit Answer" name="send">
                        _NOTSUBMIT;
                    } else {

                        if(count($_SESSION['gainedLevels']) == TOTAL_LEVELS || $_SESSION['livesUsed'] > TOTAL_LIVES) { 
                            echo <<<_WON_GAMEOVER
                            <input type="submit" class="btn btn-primary" value="Home Page" name="home_page" >
                            <input type="submit" class="btn btn-primary" value="Play Again" name="play_again" >
                            <input type="submit" class="btn btn-primary" value="Sign-Out" name="sign-out" >
                            _WON_GAMEOVER;
                        } else {
                            echo <<<_SUBMIT
                            <input type="submit" class="btn btn-primary" value="Sign-Out" name="sign-out" >
                            <input type="submit" class="btn btn-primary" value="Stop this Session" name="stop_session" >
                            _SUBMIT;

                            if (!$playerWon) {
                                echo <<<_NOTWON
                                <input type="submit" class="btn btn-primary" value="Try Again this Level" name="try_again" >
                                _NOTWON;
                            } else {
                                echo <<<_WON
                                <input type="submit" class="btn btn-primary " value="Go the Next Level" name="next_level">   
                                _WON;
                            }

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