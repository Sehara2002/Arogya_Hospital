<?php
session_start();
require_once("../DB/database.php");
$db = new database();
$con = $db->get_con();
if (isset($_SESSION["a_no"])) {
    $sql = "SELECT af_name FROM admin_users WHERE a_no=" . $_SESSION['a_no'] . ";";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["admin_name"] = $row["af_name"];
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
    <script src="https://kit.fontawesome.com/6eb5927010.js"></script>
    <link rel="stylesheet" href="../CSS/aNavbar.css">
    <link rel="stylesheet" href="../CSS/asidebar.css">
    <link rel="stylesheet" href="../CSS/adashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <nav>
        <div class="container-fluid nav-bar">
            <div class="row">
                <div class="col-sm-3">
                    <a href="dashboard.php" class="logo-link">
                        <h3>Arogya Hospital</h3>
                    </a>
                </div>
                <div class="col-sm-8"></div>

                <div class="col-sm-1">
                    <h3 id="username" onmouseenter="makeVisible()">
                        <?php
                        if (isset($_SESSION["admin_name"])) {
                            echo $_SESSION["admin_name"];
                        } else {
                            echo "Please Login First";
                        }
                        ?>
                    </h3>
                </div>


            </div>
        </div>
        <div class="hidden-menu hide" id="hidden-menu" onmouseleave="hideVisible()">
            <ul type="none">
                <li class="hidden-menu-item">
                    <a href="profile.php">My Profile</a>
                </li>
                <li class="hidden-menu-item">
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <script src="../JS/Animations.js"></script>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 side-bar">

                <div class="container link-container">
                    <div class="links "><a href="dashboard.php" class="link active-link">Dashboard</a></div>
                    <div class="links"><a href="appointments.php" class="link">Appointments</a></div>
                    <div class="links"><a href="doctors.php" class="link">Doctors</a></div>
                    <div class="links"><a href="clients.php" class="link">Clients</a></div>
                    <div class="links"><a href="patients.php" class="link">Patients</a></div>
                    <div class="links"><a href="wards.php" class="link">Wards</a></div>
                    <div class="links"><a href="payments.php" class="link">Payments</a></div>
                </div>

            </div>
            <div class="col-sm-10">
                <div class="container up">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Appointments</h2>
                                    <p class="card-text">
                                        <?php
                                        $sql = "SELECT DISTINCT COUNT(a_no) as appointments FROM appointments;";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row["appointments"];
                                        } else {
                                            echo "No Appointments";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Admitted Patients</h2>
                                    <p class="card-text">
                                    <?php
                                        $sql = "SELECT DISTINCT COUNT(admitted_patient_id) as patients FROM patient_ward_admission WHERE admission_state='Admitted';";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row["patients"];
                                        } else {
                                            echo "No Patients Admitted";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container down">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Doctors</h2>
                                    <p class="card-text">
                                    <?php
                                        $sql = "SELECT DISTINCT COUNT(d_no) as doctors FROM doctor;";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row["doctors"];
                                        } else {
                                            echo "No Doctors";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Clients</h2>
                                    <p class="card-text">
                                    <?php
                                        $sql = "SELECT DISTINCT COUNT(c_no) as clients FROM client_users;";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo $row["clients"];
                                        } else {
                                            echo "No Clients";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>