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
        <p class="big-text">Views:Patients</p>

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
            $sql = "SELECT * FROM patient_view";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<center><table class='table'><tr><th colspan='5' style='background-color:#3c9f40'><center>Patients</center></th></tr><tr><th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Town</th><th>Overseeing Doctor</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["PatientId"] . "</td><td>" . $row["PatientFirst"] . "</td><td>" . $row["PatientLast"] . "</td><td>" . $row["PatientTown"] . "</td><td>" . $row["DoctorName"] . "</td></tr>";
                }
                echo "</center></table>";
            } else {
                echo "0 results";
            }

            $conn->close();
        ?>
        <br>
        <form method="post" action="upd_patients.php">
            <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT PatientId, LastName, FirstName FROM Patient";
                $result = $conn->query($sql);
                echo "<select class='selectpicker' name='patient'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=". $row['PatientId'] . ">" . $row['LastName'] . " " . $row['FirstName'] . "</option>";
                    }
                }
                $option .= "</select>";
                $option .= "    <input class='button' type='submit' name='submit' value='Update'>";
                echo $option;

                $conn->close();
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Add" onclick="location='add_patients.php'" />
            <input class="button" type="button" value="Delete" onclick="location='del_patients.php'"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='../../index.php'">
        </form>
    </body>
</html>
