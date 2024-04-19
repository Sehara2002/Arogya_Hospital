<?php
require "./DB/database.php";
$db = new database();
$con = $db->get_con();
session_start();
if(isset($_SESSION["username"])){
    $sql = "SELECT c_no,cf_name FROM client_users WHERE c_un='".$_SESSION["username"]."'";
    $result = $con->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $_SESSION["Fname"] = $row["cf_name"];
            $_SESSION["Cno"] = $row["c_no"];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./CSS/Navbar.css">
    <title>Document</title>
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
                            <li class="nav-item"><a class="nav-link" id="link1" onclick="navClassAdder(1)">My Portal</a></li>
                            <li class="nav-item"><a href="appointment.php" class="nav-link active" id="link2" onclick="navClassAdder(2)">Appointments</a></li>
                            <li class="nav-item"><a class="nav-link" id="link3" onclick="navClassAdder(3)">History</a></li>
                            <li class="nav-item"><a class="nav-link" id="link4" onclick="navClassAdder(4)">Help</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 user text-center">
                    <div class="user">
                    <p class="username">
                        <?php echo $_SESSION["Fname"]?>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>