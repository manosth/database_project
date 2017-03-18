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
            if (isset($_POST['submit'])) {
                $todelete = $_POST['prescription'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "DELETE FROM Prescription WHERE DoctorId =" . substr($todelete, 0, 1) . " AND PatientId =" . substr($todelete, 1, 1) . " AND DrugId =" . substr($todelete, 2, 1);;
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_prescriptions.php");
                exit;
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p font-size="250%">Delete</p>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT Patient.PatientId, Doctor.DoctorId, Drug.DrugId, Patient.LastName AS PatientLast, Doctor.LastName AS DoctorName, Drug.Name
                FROM Prescription, Patient, Doctor, Drug
                WHERE Patient.PatientId = Prescription.PatientId AND Doctor.DoctorId = Prescription.DoctorId AND Drug.DrugId = Prescription.DrugId";
                $result = $conn->query($sql);

                $option = "<select class='selectpicker' name='prescription'>";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['DoctorId'] . $row['PatientId'] . $row['DrugId'] . ">" . $row['DoctorName'] . ", " . $row['PatientLast'] . ", " . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select>";

                $conn->close();
                echo $option;
            ?>
            <br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_prescriptions.php'">
        </form>
    </body>
</html>
