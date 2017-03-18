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
        <p class="big-text">Tables:Prescriptions</p>
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
            $sql = "SELECT Patient.PatientId, Doctor.DoctorId, Drug.DrugId, Patient.LastName AS PatientLast, Doctor.LastName AS DoctorName, Drug.Name, Prescription.Date, Prescription.Quantity
            FROM Prescription, Patient, Doctor, Drug
            WHERE Patient.PatientId = Prescription.PatientId AND Doctor.DoctorId = Prescription.DoctorId AND Drug.DrugId = Prescription.DrugId";
            $result = $conn->query($sql);

            echo "<center><table class='table'><tr><th colspan='6' style='background-color:#3c9f40'><center>Prescriptions</center></th></tr><tr><th>Prescription ID (Do/Pa/Dr)</th><th>Doctor Name</th><th>Patient Name</th><th>Drug</th><th>Quantity</th><th>Date</th></tr>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["DoctorId"] . $row["PatientId"] . $row["DrugId"] . "</td><td>" . $row["DoctorName"] . "</td><td>" . $row["PatientLast"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Quantity"] . "</td><td>" . $row["Date"] . "</td></tr>";
                }
            }
            echo "</center></table>";

            $conn->close();
        ?>
        <br>
        <form method="post" action="upd_prescriptions.php">
            <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql ="SELECT Patient.PatientId, Doctor.DoctorId, Drug.DrugId, Patient.LastName AS PatientLast, Doctor.LastName AS DoctorName, Drug.Name
                FROM Prescription, Patient, Doctor, Drug
                WHERE Patient.PatientId = Prescription.PatientId AND Doctor.DoctorId = Prescription.DoctorId AND Drug.DrugId = Prescription.DrugId";
                $result = $conn->query($sql);
                echo "<select class='selectpicker' name='prescription'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['DoctorId'] . $row['PatientId'] . $row['DrugId'] . ">" . $row['DoctorName'] . ", " . $row['PatientLast'] . ", " . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select>";
                $option .= "    <input class='button' type='submit' name='submit' value='Update'>";
                echo $option;

                $conn->close();
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Add" onclick="location='add_prescriptions.php'" />
            <input class="button" type="button" value="Delete" onclick="location='del_prescriptions.php'"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='../../index.php'">
        </form>
    </body>
</html>
