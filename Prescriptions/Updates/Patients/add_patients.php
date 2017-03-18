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
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $age = $_POST['age'];
                $town = $_POST['town'];
                $street = $_POST['street'];
                $streetno = $_POST['streetno'];
                $postalc = $_POST['postalc'];
                $doctor = $_POST['doctor'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = 'INSERT INTO `Patient`(`FirstName`, `LastName`, `Age`, `Town`, `StreetName`, `StreetNumber`, `PostalCode`, `DoctorId`)
                VALUES ("' . $firstname . '","' . $lastname . '","' . $age . '","' . $town . '","' . $street . '","' . $streetno . '","'. $postalc . '","'. $doctor .'")';
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_patients.php");
                exit;
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p font-size="250%">First name</p>
            <div class='col-xs-4'><input type="text" class="form-control"   name="firstname"></div><br><br>
            <p font-size="250%">Last name</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="lastname"></div><br><br>
            <p font-size="250%">Age</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="age"></div><br><br>
            <p font-size="250%">Town</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="town"></div><br><br>
            <p font-size="250%">Street name</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="street"></div><br><br>
            <p font-size="250%">Street number</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="streetno"></div><br><br>
            <p font-size="250%">Postal code</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="postalc"></div><br><br>
            <p font-size"250%">Doctor</p>
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
                $sql = "SELECT FirstName, LastName, DoctorId, Specialty FROM Doctor";
                $result = $conn->query($sql);
                echo "<div class='col-xs-4'><select class='selectpicker' name='doctor'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['DoctorId'] . ">" . $row['LastName'] . " " . $row['FirstName'] . ", " . $row['Specialty'] . "</option>";
                    }
                }
                $option .= "</select></div><br>";
                echo $option;

                $conn->close();
            ?>
            <br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_patients.php'">
        </form>
    </body>
</html>
