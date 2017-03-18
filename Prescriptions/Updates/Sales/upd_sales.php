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
                $price = $_POST['price'];
                $pharmacy = $_POST['pharmacy'];
                $drug = $_POST['drug'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Sell` SET `Price`=? WHERE `PharmacyId`=? AND `DrugId`=?");
                $stmt->bind_param("ddd", $price, $pharmacy, $drug);
                $stmt->execute();

                $conn->close();
                header("Location:table_sales.php");
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
                    $saleid = $_POST['sale'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Sell
                    WHERE Sell.PharmacyId =" . substr($saleid, 0, 1) . " AND Sell.DrugId =" . substr($saleid, 1, 1);
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldpharmacy = $row['PharmacyId'];
                        $olddrug = $row['DrugId'];
                        $oldprice = $row['Price'];
                    }

                    $sql = "SELECT Name AS Pharmacy, PharmacyId
                    FROM Pharmacy
                    WHERE Pharmacy.PharmacyId =" . $oldpharmacy;
                    $result = $conn->query($sql);
                    echo "<p font-size='250%'>Pharmacy</p>";

                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='pharmacy' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['Pharmacy'] . " readonly></div>";
                            $second .= $row['PharmacyId'] . "></div><br><br>";
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

                    $outp = "<p font-size='250%''>Price</p>";
                    $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='price' value='" . $oldprice . "'></div><br><br>";
                    echo $outp;

                    $conn->close();
                }
            ?>
            <br>
            <input class="button" type="submit" name="update" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_sales.php'">
        </form>
    </body>
</html>
