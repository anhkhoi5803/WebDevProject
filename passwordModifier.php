
<?php

//require_once "process.php";

?>

<!-- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Password Modifier</h2>
        <p>Please fill in this form to modify your account.</p>
        <form action="process.php" method="post">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                <span class="invalid-feedback"></span>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control">
                <span class="invalid-feedback"></span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="invalid-feedback"></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Modify">                
            </div>
            <p>Already have an account? <a href="">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>