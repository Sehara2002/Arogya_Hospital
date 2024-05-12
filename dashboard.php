<?php
require "./DB/database.php";
$db = new database();
$con = $db->get_con();
session_start();
if (isset($_SESSION["username"])) {
    $sql = "SELECT c_no,cf_name FROM client_users WHERE c_un='" . $_SESSION["username"] . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["Fname"] = $row["cf_name"];
            $_SESSION["c_id"] = $row["c_no"];
            $name = $row["cf_name"];
        }
    }
    $message = "Welcome Back, " . $_SESSION['Fname'];
} else {
    $message = "Welcome to the Arogya Hospital";
    $name = "";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6eb5927010.js"></script>
    <link rel="stylesheet" href="./CSS/Navbar.css">
    <link rel="stylesheet" href="./CSS/dashboard.css">
    <title>Arogya Hospital</title>
</head>

<body>
    <nav>
        <div class="container-fluid nav-container">
            <div class="row">
                <div class="col-sm-3">
                    <a href="index.php" class="logo">
                        Arogya Hospital
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="container navbar">
                        <script src="./JS/Animations.js"></script>
                        <ul class="nav-bar">
                            <li class="nav-item"><a href="dashboard.php" class="nav-link active" id="link1" onclick="navClassAdder(1)">My Portal</a></li>
                            <li class="nav-item"><a href="appointment.php" class="nav-link" id="link2" onclick="navClassAdder(2)">Appointments</a></li>
                            <li class="nav-item"><a href="history.php" class="nav-link" id="link3" onclick="navClassAdder(3)">History</a></li>
                            <li class="nav-item"><a href="help.php" class="nav-link" id="link4" onclick="navClassAdder(4)">Help</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 user text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="container button">
                                <a href="logout.php" class="btn btn-danger" id="logout">Logout</a>
                                <a href="index.php" id="login" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="user">
                                <p class="username">
                                    <?php echo $name; ?>
                                </p>
                            </div>
                        </div>
                    </div>



                </div>

                <?php
                if (isset($_SESSION["username"])) {
                    echo "<script>
                        document.getElementById('login').classList.add('hide');
                        document.getElementById('logout').classList.add('show');
                        document.getElementById('username').classList.add('show');
                        
                        </script>";
                } else {
                    echo "<script>
                        document.getElementById('login').classList.add('show');
                        document.getElementById('logout').classList.add('hide');
                        document.getElementById('username').classList.add('show');

                        </script>";
                }
                ?>
            </div>
        </div>
        </div>
    </nav>



    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="container banner-section">
                    <div class="main-title">
                        <p class="topic"><?php echo $message; ?></p>
                        <p class="theme-text">Your health is our wealth</p>
                        <div class="button-section text-center">
                            <a href="./appointment.php" class="btn btn-primary text-center btn1">Make Appointment</a>
                            <a href="./contact.php" class="btn btn-primary text-center btn2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="appointments" id="appointment-section">
        <div class="container-fluid app-sec">
            <h1 class="section-head text-center">Appointment Details</h1>
            <div class="row">
                <div class="col-sm-6 col-container">
                    <!--<div class="card upcoming">-->
                    <div class="card my-card">
                        <div class="card-body">
                            <h2 class="card-title">Upcoming Appointments</h2>
                        </div>
                        <img src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM appointments WHERE c_no = " . $_SESSION['c_id'] . " LIMIT 0,1;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <h5><?php echo $row["a_date"] . " - Dr." . $row["df_name"] ?></h5>
                            <?php
                                }
                            } else {
                                echo "<p class='warning body-text'>No Records Found</p>";
                            }
                            ?>
                            <a href="#" class="card-link">View More</a>
                        </div>
                    </div>
                    <!--</div>-->
                </div>
                <div class="col-sm-6 col-container">
                    <div class="card my-card">
                        <div class="card-body">
                            <h3 class="card-title">Medical History</h3>

                        </div>
                        <img src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-text">Text</p>
                            <p class="card-text">Text</p>
                            <p class="card-text">Text</p>
                            <p class="card-text">Text</p>
                            <a href="#" class="card-link">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>