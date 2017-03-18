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
                $pharmacy = $_POST['pharmacy'];
                $company = $_POST['company'];
                $text = $_POST['text'];
                $start = $_POST['start'];
                $end = $_POST['end'];
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
                $stmt = $conn->prepare("UPDATE `Contract` SET `Text`=?, `StartDate`=?, `EndDate`=?, `Supervisor`=? WHERE `PharmacyId`=? AND `PharmaceuticalCompanyId`=?");
                $stmt->bind_param("ssssdd", $text, $start, $end, $super, $pharmacy, $company);
                $stmt->execute();

                $conn->close();
                header("Location:table_contracts.php");
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
                    $contractid = $_POST['contract'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Contract
                    WHERE Contract.PharmacyId =" . substr($contractid, 0, 1) . " AND Contract.PharmaceuticalCompanyId =" . substr($contractid, 1, 1);
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldpharmacy = $row['PharmacyId'];
                        $oldcompany = $row['PharmaceuticalCompanyId'];
                        $oldtext = $row['Text'];
                        $oldstart = $row['StartDate'];
                        $oldend = $row['EndDate'];
                        $oldsuper = $row['Supervisor'];
                    }

                    $sql = "SELECT Name, PharmacyId
                    FROM Pharmacy
                    WHERE Pharmacy.PharmacyId =" . $oldpharmacy;
                    $result = $conn->query($sql);

                    echo "<p font-size='250%'>Pharmacy</p>";
                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='pharmacy' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['Name'] . " readonly></div>";
                            $second .= $row['PharmacyId'] . "></div><br><br>";
                        }
                    }
                    echo $option;
                    echo $second;

                    $sql = "SELECT Name, PharmaceuticalCompanyId
                    FROM PharmaceuticalCompany
                    WHERE PharmaceuticalCompany.PharmaceuticalCompanyId =" . $oldcompany;
                    $result = $conn->query($sql);

                    echo "<p font-size='250%'>Company</p>";
                    $option = "<div class='col-xs-4'><input type='text' class='form-control' value=";
                    $second = "<div class='col-xs-4'><input type='hidden' class='form-control' name='company' value=";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= $row['Name'] . " readonly></div>";
                            $second .= $row['PharmaceuticalCompanyId'] . "></div><br><br>";
                        }
                    }
                    echo $option;
                    echo $second;

                    $outp = "<p font-size='250%''>Text</p>";
                    $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='text' value='" . $oldtext . "'></div><br><br>";
                    $outp .= "<p font-size='250%'>Start Date (Y-M-D)</p>";
                    $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='start' value='" . $oldstart . "'></div><br><br>";
                    $outp .= "<p font-size='250%'>End Date (Y-M-D)</p>";
                    $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='end' value='" . $oldend . "'></div><br><br>";
                    $outp .= "<p font-size='250%'>Supervisor</p>";
                    $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='super' value='" . $oldsuper . "'></div><br><br>";
                    echo $outp;

                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_contracts.php'">
        </form>
    </body>
</html>
