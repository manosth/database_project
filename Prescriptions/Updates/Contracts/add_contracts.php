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
                $pharmacy = $_POST['pharmacy'];
                $company = $_POST['company'];
                $start = $_POST['start'];
                $end = $_POST['end'];
                $text = $_POST['text'];
                $super = $_POST['super'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = 'INSERT INTO `Contract`(`PharmacyId`, `PharmaceuticalCompanyId`, `StartDate`, `EndDate`, `Text`, `Supervisor`)
                VALUES ("' . $pharmacy . '","' . $company . '","' . $start . '","' . $end . '","' . $text . '","' . $super . '")';
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_contracts.php");
                exit;
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
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
                $sql = "SELECT Name, PharmacyId FROM Pharmacy";
                $result = $conn->query($sql);
                echo "<p font-size='250%'>Pharmacy</p>";
                echo "<div class='col-xs-4'><select class='selectpicker' name='pharmacy'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['PharmacyId'] . ">" . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select></div><br><br>";
                echo $option;

                $sql = "SELECT Name, PharmaceuticalCompanyId FROM PharmaceuticalCompany";
                $result = $conn->query($sql);
                echo "<p font-size='250%'>Pharmaceutical Company</p>";
                echo "<div class='col-xs-4'><select class='selectpicker' name='company'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['PharmaceuticalCompanyId'] . ">" . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select></div><br><br>";
                echo $option;

                $conn->close();
            ?>
            <p font-size='250%'>Start Date (Y-M-D)</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="start"></div><br><br>
            <p font-size='250%'>End Date (Y-M-D)</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="end"></div><br><br>
            <p font-size='250%'>Text</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="text"></div><br><br>
            <p font-size='250%'>Supervisor</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="super"></div><br><br>
            <br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_contracts.php'">
        </form>
    </body>
</html>
