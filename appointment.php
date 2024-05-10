<?php
require "./DB/appointments.php";
$db = new database();
$con = $db->get_con();
session_start();
if (isset($_SESSION["username"])) {
    $sql = "SELECT c_no,cf_name,cl_name FROM client_users WHERE c_un='" . $_SESSION["username"] . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["Lname"] = $row["cl_name"];
        }
    }
}

if (isset($_POST["place-appointment"])) {
    $appoinments = 0;
    $capcity = 0;
    $doctor = $_POST["doctor_name"];
    $doctor_array = explode("-", $doctor);
    $docNo = (int)$doctor_array[1];
    $sql = "SELECT DISTINCT COUNT(a_no) FROM appointments WHERE d_no=$docNo";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointments = (int)$row['COUNT(a_no)'];
        }
    }

    $sql = "SELECT patient_capacity FROM doctor WHERE d_no=$docNo";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $capacity = (int)$row['patient_capacity'];
        }
    }

    if ($capacity > $appointments) {
        $sql = '';
    }else{
        $message = "Cannot Place your Appointment.Appointment Count of the Doctor is Over.";
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
    <link rel="stylesheet" href="./CSS/appointment.css">
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
                            <li class="nav-item"><a href="dashboard.php" class="nav-link active" id="link1" onclick="navClassAdder(1)">My Portal</a></li>
                            <li class="nav-item"><a href="appointment.php" class="nav-link" id="link2" onclick="navClassAdder(2)">Appointments</a></li>
                            <li class="nav-item"><a href="history.php" class="nav-link" id="link3" onclick="navClassAdder(3)">History</a></li>
                            <li class="nav-item"><a href="help.php" class="nav-link" id="link4" onclick="navClassAdder(4)">Help</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 user text-center">
                    <div class="user">
                        <p class="username">
                            <?php echo $_SESSION["Fname"] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="root">
            <form action="" method="post" class="form-appointment">
                <h1 class="title-text text-center">
                    Make Your Appointment
                </h1>
                <div class="inputs">
                    <div class="input-group">
                        <div class='alert-box alert alert-info' role='alert'>
Notice :
Please note that all the doctors are available after 4.00PM.
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="c_no">Patient No: </label>
                        <br>
                        <input type="text" name="c_no" value="<?php echo $_SESSION["c_id"] ?>" class="input-field">
                    </div>
                    <div class="input-group">
                        <label for="c_name">Patient Name: </label>
                        <input type="text" name="c_name" class="input-field" value="<?php echo $_SESSION["Fname"] . " " . $_SESSION["Lname"]  ?>" />
                    </div>
                    <div class="input-group">
                        <label for="">Doctor Name: </label>
                        <br>
                        <select name="doctor_name" id="doctor-name" class="input-field" value="">
                            <?php
                            $sql = "SELECT d_no,df_name,dl_name FROM doctor";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['df_name'] . " " . $row['dl_name'] . "-" . $row['d_no'] ?> "><?php echo $row['df_name'] . " " . $row['dl_name'] . "-" . $row['d_no'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="appointment-time">Select Appointment Date</label>
                        <input type="Date" class="input-field" name="appointment-Date">
                    </div>
                    <div class="input-group">
                    <label for="appointment-desc">Appointment Description</label>
                    <textarea name="appointment-desc" id="" class="input-field"cols="72" rows="4"></textarea>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-primary submit-button" name="place-appointment"> Place Appointment </button>
    
                    </div>


            </form>
        </div>
    </main>





</body>

</html>