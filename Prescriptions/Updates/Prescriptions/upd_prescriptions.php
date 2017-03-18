<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="../../index.css">
        <script src="https://use.fontawesome.com/4f989e9bc6.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    </head>
    <body>
        <?php
            if (isset($_POST['update'])) {
                $doctor = $_POST['doctor'];
                $patient = $_POST['patient'];
                $drug = $_POST['drug'];
                $quantity = $_POST['quantity'];
                $date = $_POST['date'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Prescription` SET `Quantity`=?, `Date`=? WHERE `DoctorId`=? AND `PatientId`=? AND `DrugId`=?");
                $stmt->bind_param("dsddd", $quantity, $date, $doctor, $patient, $drug);
                $stmt->execute();

                $conn->close();
                header("Location:table_prescriptions.php");
                exit;
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <?php
                if (isset($_POST['submit'])) {
                    $servername = "localhost";
                    $username = "root";
                    $password = NULL;
                    $dbname = "Prescriptions-R-X";
                    $prescriptionid = $_POST['prescription'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Prescription
                    WHERE Prescription.DoctorId =" . substr($prescriptionid, 0, 1) . " AND Prescription.PatientId =" . substr($prescriptionid, 1, 1) . " AND Prescription.DrugId =" . substr($prescriptionid, 2, 1);
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $olddoctor = $row['DoctorId'];
                        $oldpatient = $row['PatientId'];
                        $olddrug = $row['DrugId'];
                        $oldquantity = $row['Quantity'];
                        $olddate = $row['Date'];
                    }

                    $sql = "SELECT LastName AS DoctorLast, DoctorId
                    FROM Doctor
                    WHERE Doctor.DoctorId =" . $olddoctor;
                    $result = $conn->query($sql);
                    echo "<p font-size='250%'>Doctor</p>";

                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='doctor' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['DoctorLast'] . " readonly></div>";
                            $second .= $row['DoctorId'] . "></div><br><br>";
                        }
                    }
                    echo $option;
                    echo $second;

                    $sql = "SELECT LastName AS PatientLast, PatientId
                    FROM Patient
                    WHERE Patient.PatientId =" . $oldpatient;
                    $result = $conn->query($sql);
                    echo "<p font-size='250%'>Patient</p>";

                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='patient' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['PatientLast'] . " readonly></div>";
                            $second .= $row['PatientId'] . "></div><br><br>";
                        }
                    }
                    echo $option;
                    echo $second;

                    $sql = "SELECT Name, DrugId
                    FROM Drug
                    WHERE Drug.DrugId =" . $olddrug;
                    $result = $conn->query($sql);
                    echo "<p font-size='250%'>Drug</p>";

                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='drug' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['Name'] . " readonly></div>";
                            $second .= $row['DrugId'] . "></div><br><br>";
                        }
                    }
                    echo $option;
                    echo $second;

                    $outp = "<p font-size='250%''>Quantity</p>";
                    $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='quantity' value='" . $oldquantity . "'></div><br><br>";
                    $outp .= "<p font-size='250%'>Date (Y-M-D)</p>";
                    $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='date' value='" . $olddate . "'></div><br><br>";
                    echo $outp;

                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_prescriptions.php'">
        </form>
    </body>
</html>
