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
                $specialty = $_POST['spec'];
                $experience = $_POST['exp'];
                $doctorid = $_POST['doctor'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Doctor` SET `FirstName`=?, `LastName`=?, `Specialty`=?, `ExperienceYears`=? WHERE `DoctorId`=?");
                $stmt->bind_param("sssdd", $firstname, $lastname, $specialty, $experience, $doctorid);
                $stmt->execute();

                $conn->close();
                header("Location:table_doctors.php");
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
                    $doctorid = $_POST['doctor'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Doctor
                    WHERE Doctor.DoctorId =" . $doctorid;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldfirst = $row['FirstName'];
                        $oldlast = $row['LastName'];
                        $oldspec = $row['Specialty'];
                        $oldexp = $row['ExperienceYears'];

                        $outp = "<p font-size='250%''>First name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='firstname' value='" . $oldfirst . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Last name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='lastname' value='" . $oldlast . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Specialty</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='spec' value='" . $oldspec . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Years of Experience</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='exp' value='" . $oldexp . "'></div><br><br>";
                        $outp .= "<input type='hidden' class='form-control' name='doctor' value='" .$doctorid . "'/>";
                        echo $outp;
                    }
                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_doctors.php'">
        </form>
    </body>
</html>
