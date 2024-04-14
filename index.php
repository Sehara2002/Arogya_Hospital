<?php

session_start();
require "./DB/client_users.php";

if (isset($_POST["btn-signin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new Client_users();
    $result = $user->login($username, $password);
    if ($result) {
        echo "<script>alert('Login Successful');
                location.replace('./dashboard.php?username=".$username."');
        </script>";
    } else {
        echo "<script>alert('Login Failed');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/loginPage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Arogya Hospital</title>
</head>

<body>

    <div class="login-form">
        <div class="row">
            <div class="col-sm-6 image text-center">
                <h1>Arogya Hospital</h1>
                <h3>Official Web Portal</h3>
                <p></p>
            </div>
            <div class="col-sm-6 form">
                <img src="./images/usericon.png" alt="" class="user-logo">
                <script src="./JS/Validation.js"></script>
                <form action="" class="login-frm" method="POST" onsubmit="validate_login()">
                    <div class="inputs">
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                        <br />
                        <input type="text" name="password" id="password" placeholder="Password" class="form-control">
                        <br>
                        <input type="submit" name="btn-signin" value="Sign in" class="btn btn-primary form-control">
                        <br />
                        <br />
                        <input type="reset" value="Cancel" class="btn btn-danger form-control">
                        <p>Don't have an account ? <a href="signup.php">Create Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>