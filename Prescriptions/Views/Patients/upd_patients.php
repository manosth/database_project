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
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $age = $_POST['age'];
                $town = $_POST['town'];
                $street = $_POST['street'];
                $streetno = $_POST['streetno'];
                $postalc = $_POST['postalc'];
                $doctor = $_POST['doctor'];
                $patientid = $_POST['patient'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Patient` SET `FirstName`=?, `LastName`=?, `Age`=?, `Town`=?,`StreetName`=?,`StreetNumber`=?,`PostalCode`=?, `DoctorId`=? WHERE `PatientId`=?");
                $stmt->bind_param("ssdssdddd", $firstname, $lastname, $age, $town, $street, $streetno, $postalc, $doctor, $patientid);
                $stmt->execute();

                $conn->close();
                header("Location:view_patients.php");
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
                    $patientid = $_POST['patient'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Patient
                    WHERE Patient.PatientId =" . $patientid;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldfirst = $row['FirstName'];
                        $oldlast = $row['LastName'];
                        $oldage = $row['Age'];
                        $oldtown = $row['Town'];
                        $oldstreet = $row['StreetName'];
                        $oldstreetno = $row['StreetNumber'];
                        $oldpostc = $row['PostalCode'];
                        $olddoctor = $row['DoctorId'];

                        $outp = "<p font-size='250%''>First name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='firstname' value='" . $oldfirst . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Last name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='lastname' value='" . $oldlast . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Age</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='age' value='" . $oldage . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Town</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='town' value='" . $oldtown . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Street name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='street' value='" .$oldstreet . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Street number</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='streetno' value='" .$oldstreetno . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Postal code</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='postalc' value='" .$oldpostc . "'></div><br><br>";
                        $outp .= "<input type='hidden' class='form-control' name='patient' value='" . $patientid . "'/>";
                        echo $outp;
                    }

                    $sql = "SELECT LastName AS DoctorLast, Specialty, DoctorId
                    FROM Doctor
                    WHERE Doctor.DoctorId =" . $olddoctor;

                    $result = $conn->query($sql);
                    echo "<p font-size='250%'>Doctor</p>";
                    echo "<div class='col-xs-4'><select class=\"selectpicker\" name=\"doctor\">";
                    $option = "";

                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= "<option value=" . $row['DoctorId'] . " selected>" . $row['DoctorLast'] . ", " . $row['Specialty'] . "</option>";
                        }
                    }

                    $sql = "SELECT LastName AS DoctorLast, DoctorId, Specialty
                    FROM Doctor
                    WHERE Doctor.DoctorId !=" . $olddoctor;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= "<option value=". $row['DoctorId'] . ">" . $row['DoctorLast'] . ", " . $row['Specialty'] . "</option>";
                        }
                    }
                    $option .= "</select></div><br><br>";
                    echo $option;
                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='view_patients.php'">
        </form>
    </body>
</html>
