<?php

session_start();

require "./DB/client_users.php";

if (isset($_POST["btn-signin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db = new database();
    $con = $db->get_con();
    $sql = "SELECT username,password,role,user_id FROM user_login WHERE username = '" . $username . "';";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $db_un = $row["username"];
            $db_pw = $row["password"];
            $db_role = $row["role"];
            if (($db_un == $username) && ($db_pw == $password) && ($db_role == 'admin')) {
                $_SESSION["username"] = $username;
                $_SESSION["a_no"] = $row['user_id'];
                echo "<script>alert('Login Successful');
                location.replace('./Admin/dashboard.php');
                </script>";
            } else if(($db_un == $username) && ($db_pw == $password) && ($db_role == 'client')) {
                $_SESSION["username"] = $username;
                $_SESSION["c_no"] = $row['user_id'];
                echo "<script>alert('Login Successful');
                location.replace('./dashboard.php');
                </script>";
            }else{
                echo "<script>console.log('Login failed');</script>";
            }
        }
    }else{
        echo "<script>console.log('Record not Found');</script>";
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