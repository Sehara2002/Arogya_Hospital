<?php
    require "./DB/client_users.php";

    if(isset($_POST["btn-signup"])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $email= $_POST["email"];
        $password= $_POST["password"];
        $contact= $_POST["contact"];
        $e_contact= $_POST["e_contact"];
        $username = $_POST["username"];
        $user = new Client_users();
        $result = $user->create_user((string)$fname,(string)$lname,(int)$age,(string)$gender,(string)$email,(string)$contact,(string)$e_contact,(string)$username,(string)$password);
        if($result===true){
            echo "<script>alert('User Added');</script>";
        }else{
            echo "<script>alert('User cannot add');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/signup.css">
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
                <script src="./JS/Validation.js"></script>
                <form action="" class="login-frm" method="POST" onsubmit="validate_signup()">
                    <div class="inputs">
                        <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control">
                        <br />
                        <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control">
                        <br>
                        <input type="text" name="age" id="age" placeholder="Age" class="form-control">
                        <br />
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <br/>
                        <input type="text" name="email" id="email" placeholder="Email Address" class="form-control">
                        <br>
                        <input type="text" name="contact" id="contact" placeholder="Contact Number" class="form-control">
                        <br>
                        <input type="text" name="e_contact" id="e_contact" placeholder="Emergency Contact Number" class="form-control">
                        <br>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                        <br />
                        <input type="text" name="password" id="password" placeholder="Password" class="form-control">
                        <br>
                        <input type="submit" name="btn-signup" value="Sign up" class="btn btn-primary form-control">
                        <br />
                        <br />
                        <input type="reset" value="Cancel" class="btn btn-danger form-control">
                        <p>Already have an account ? <a href="index.php">Sign in Here</a></p>
                    </div>


                </form>
            </div>
        </div>
    </div>

</body>

</html>