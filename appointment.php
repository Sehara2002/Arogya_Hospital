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
            $_SESSION["Fname"] = $row["cf_name"];
            $_SESSION["Lname"] = $row["cl_name"];
            $_SESSION["cno"] = $row["c_no"];
        }
    }
}

if (isset($_POST["place-appointment"])) {
    $appoinments = 0;
    $capcity = 0;
    $doctor = $_POST["doctor_name"];
    $doctor_array = explode("-", $doctor);
    $docNo = (int)$doctor_array[1];
    $docName = (string)$doctor_array[0];
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
    $message = '';
    if ($capacity > $appointments) {
        $c_no = $_SESSION["cno"];
        $cfname = $_SESSION["Fname"];
        $d_no = $docNo;
        $d_name = $docName;
        $a_date = $_POST["appointment-Date"];
        $a_desc = $_POST["appointment-desc"];
        $appointment = new appointments();
        $id = $appointment->placeAppointments($c_no, $cfname, $d_no, $d_name, $a_date, '16:00', $a_desc, 2000.00, 'Pending');
        if ($id != -1) {
            $message = "Your Appointment Successfully Added. Appointment ID : $id";
        } else {
            $message = "Appointment Cannot Place";
        }
    } else {
        $message = "Cannot Place your Appointment.Appointment Count of the Doctor is Over.";
    }
    
    if(isset($_POST["update-appointment"])){
        
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
                            <li class="nav-item"><a href="dashboard.php" class="nav-link" id="link1" onclick="navClassAdder(1)">My Portal</a></li>
                            <li class="nav-item"><a href="appointment.php" class="nav-link active" id="link2" onclick="navClassAdder(2)">Appointments</a></li>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
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
                                    if (isset($_SESSION["udf_name"]) && isset($_SESSION["ud_no"])) {
                                    ?>
                                        <option value="<?php echo $_SESSION["udf_name"] . "-" . $_SESSION["ud_no"]; ?>">
                                            <?php echo $_SESSION["udf_name"] . "-" . $_SESSION["ud_no"]; ?>
                                        </option>
                                        <?php
                                    }
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
                                <input type="Date" class="input-field" name="appointment-Date" value="<?php
                                                                                                        if (isset($_SESSION["ua_date"])) {
                                                                                                            echo $_SESSION["ua_date"];
                                                                                                        }
                                                                                                        ?>">
                            </div>
                            <div class="input-group">
                                <label for="appointment-desc">Appointment Description</label>
                                <textarea name="appointment-desc" id="" class="input-field" cols="72" rows="4">
                                <?php echo $_SESSION["ua_desc"] . "<br/>"; ?>
                                </textarea>
                            </div>
                            <div class="input-group">
                                <button class="btn btn-primary submit-button" name="place-appointment"> Place Appointment </button>
                            </div>
                            <div class="input-group">
                                <button class="btn btn-primary submit-button" name="update-appointment"> Update Appointment </button>

                            </div>
                            <div class="input-group">
                                <div class="alert alert-box alert-info">
                                    <h1><?php if (isset($message)) {
                                            echo $message;
                                        } ?></h1>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="history">
                    <h1 class="title-text text-center">
                        Appointment History
                    </h1>
                    <table width="100%" class="table">
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
                            $sql = "SELECT * FROM appointments WHERE c_no = " . $_SESSION['cno'] . " ORDER BY a_date ASC";
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
    </main>
</body>

</html>