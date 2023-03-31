<?php

echo <<<_NAVBAR
<nav class="navbar">
        <div class="navbar__container">
            <a href="#home" id="navbar__logo">Final Project</a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="index.php" class="navbar__links" id="home-page">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="history.php" class="navbar__links" id="History-page">History</a>
                </li>
                <li class="navbar__item">
                    <a href="login.php" class="navbar__links" id="login-page">Login</a>
                </li>
                <li class="navbar__btn">
                    <a href="register.php" class="button" id="sign-up">Sign Up</a>
                </li>
            </ul>

        </div>
    </nav> 

_NAVBAR;
?>

