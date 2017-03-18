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
                $specialty = $_POST['spec'];
                $experience = $_POST['exp'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = 'INSERT INTO `Doctor`(`FirstName`, `LastName`, `Specialty`, `ExperienceYears`)
                VALUES ("' . $firstname . '","' . $lastname . '","' . $specialty . '","' . $experience .'")';
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_doctors.php");
                exit;
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p font-size="250%">First name</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="firstname"></div><br><br>
            <p font-size="250%">Last name</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="lastname"></div><br><br>
            <p font-size="250%">Specialty</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="spec"></div><br><br>
            <p font-size="250%">Years of Experience</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="exp"></div><br><br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_doctors.php'">
        </form>
    </body>
</html>
