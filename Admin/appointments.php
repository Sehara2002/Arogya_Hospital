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
    <link rel="stylesheet" href="../CSS/aappointments.css">
    <title>Appointments :: Admin</title>
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
                    <div class="links"><a href="dashboard.php" class="link">Dashboard</a></div>
                    <div class="links"><a href="appointments.php" class="link active-link">Appointments</a></div>
                    <div class="links"><a href="doctors.php" class="link">Doctors</a></div>
                    <div class="links"><a href="clients.php" class="link">Clients</a></div>
                    <div class="links"><a href="patients.php" class="link">Patients</a></div>
                    <div class="links"><a href="wards.php" class="link">Wards</a></div>
                    <div class="links"><a href="payments.php" class="link">Payments</a></div>
                </div>

            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-4">
                        <form class="appointment-form" action="" method="post">
                            <h3 class="title-text text-center">
                                Make Your Appointment
                            </h3>
                            <div class="input-group">
                                <div class='alert-box alert alert-info' role='alert'>
                                    Notice :
                                    Please note that all the doctors are available after 4.00PM.
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="">Client No: </label>
                                <br>
                                <input type="text" class="input-field">
                            </div>
                            <div class="input-group">
                                <label for="">Client Name: </label>
                                <br>
                                <input type="text" class="input-field">
                            </div>
                            <div class="input-group">
                                <label for="">Doctor No: </label>
                                <br>
                                <input type="text" class="input-field">
                            </div>
                            <div class="input-group">
                                <label for="">Doctor Name: </label>
                                <br>
                                <input type="text" class="input-field">
                            </div>
                            <div class="input-group">
                                <label for="">Date:</label>
                                <br>
                                <input type="Date" class="input-field">
                            </div>
                            <div class="input-group">
                                <button class="btn btn-primary submit-button left" name="place-appointment"> Place Appointment </button>
                                <button class="btn btn-primary submit-button" name="update-appointment"> Update Appointment </button>
                            </div>

                        </form>
                    </div>
                    <div class="col-sm-8">
                        <div class="history">
                            <h3 class="title-text text-center">
                                Appointment History
                            </h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="c-headers">
                                            Appointment Number
                                        </th>
                                        <th class="c-headers">
                                            Doctor Number
                                        </th>
                                        <th class="c-headers">
                                            Doctor Name
                                        </th>
                                        <th class="c-headers">
                                            Appointment Date
                                        </th>
                                        <th class="c-headers">
                                            Appointment State
                                        </th>
                                        <th class="c-headers">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM appointments ORDER BY a_date ASC";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr class="appointment-row">
                                                <td class="appointment-data"><?php echo $row['a_no'] ?></td>
                                                <td class="appointment-data"><?php echo $row['d_no'] ?></td>
                                                <td class="appointment-data"><?php echo $row['df_name'] ?></td>
                                                <td class="appointment-data"><?php echo $row['a_date'] ?></td>
                                                <td class="appointment-data"><?php echo $row['a_state'] ?></td>
                                                <td class="appointment-data">
                                                    <a href="./DB/appointments.php?u_id=<?php echo $row['a_no'] ?>">
                                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="delete-icon" href="./DB/appointments.php?a_id=<?php echo $row['a_no'] ?>">
                                                        <i class="fa fa-trash delete-icon" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "
                                    <div class='alert alert-box danger-alert'>
                                    <p> No Record Found</p>
                                    </div>
                                    ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>