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
                $name = $_POST['name'];
                $streetname = $_POST['streetname'];
                $streetnumber = $_POST['streetnumber'];
                $postal = $_POST['postal'];
                $town = $_POST['town'];
                $pharmacyid = $_POST['pharmacy'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Pharmacy` SET `Name`=?, `StreetName`=?, `StreetNumber`=?, `PostalCode`=?, `Town`=? WHERE `PharmacyId`=?");
                $stmt->bind_param("ssddsd", $name, $streetname, $streetnumber, $postal, $town, $pharmacyid);
                $stmt->execute();

                $conn->close();
                header("Location:table_pharmacies.php");
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
                    $pharmacyid = $_POST['pharmacy'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Pharmacy
                    WHERE Pharmacy.PharmacyId =" . $pharmacyid;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldname = $row['Name'];
                        $oldstreet = $row['StreetName'];
                        $oldstreetno = $row['StreetNumber'];
                        $oldpostal = $row['PostalCode'];
                        $oldtown = $row['Town'];

                        $outp = "<p font-size='250%''>Name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='name' value='" . $oldname  . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Street Name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='streetname' value='" . $oldstreet . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Street Number</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='streetnumber' value='" . $oldstreetno . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Postal Code</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='postal' value='" . $oldpostal . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Town</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='town' value='" . $oldtown . "'></div><br><br>";
                        $outp .= "<input type='hidden' class='form-control' name='pharmacy' value='" .$pharmacyid . "'/>";
                        echo $outp;
                    }
                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_pharmacies.php'">
        </form>
    </body>
</html>
