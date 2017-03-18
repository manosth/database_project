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
                $drug = $_POST['drug'];
                $price = $_POST['price'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = 'INSERT INTO `Sell`(`PharmacyId`, `DrugID`, `Price`)
                VALUES ("' . $pharmacy . '","' . $drug . '","' . $price .'")';
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_sales.php");
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

                $sql = "SELECT Name, DrugId FROM Drug";
                $result = $conn->query($sql);
                echo "<p font-size='250%'>Drug</p>";
                echo "<div class='col-xs-4'><select class='selectpicker' name='drug'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['DrugId'] . ">" . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select></div><br><br>";
                echo $option;

                $conn->close();
            ?>
            <p font-size='250%'>Price</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="price"></div><br><br>
            <br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_sales.php'">
        </form>
    </body>
</html>
