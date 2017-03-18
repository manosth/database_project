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
                $formula = $_POST['formula'];
                $pharmaid = $_POST['pharma'];
                $drugid = $_POST['drug'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `Drug` SET `Name`=?, `Formula`=?, `PharmaceuticalCompanyId`=? WHERE `DrugId`=?");
                $stmt->bind_param("ssdd", $name, $formula, $pharmaid, $drugid);
                $stmt->execute();

                $conn->close();
                header("Location:table_drugs.php");
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
                    $drugid = $_POST['drug'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM Drug
                    WHERE Drug.DrugId =" . $drugid;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldname = $row['Name'];
                        $oldformula = $row['Formula'];
                        $oldpharma = $row['PharmaceuticalCompanyId'];

                        $outp = "<p font-size='250%''>Name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='name' value='" . $oldname . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Formula</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='formula' value='" . $oldformula . "'></div><br><br>";
                        $outp .= "<input type='hidden' class='form-control' name='drug' value='" .$drugid . "'/>";
                        echo $outp;
                    }

                    $sql = "SELECT Name AS PharmaName, PharmaceuticalCompanyId
                    FROM PharmaceuticalCompany
                    WHERE PharmaceuticalCompany.PharmaceuticalCompanyId =" . $oldpharma;
                    $result = $conn->query($sql);

                    echo "<p font-size='250%'>Pharmaceutical Company</p>";
                    echo "<div class='col-xs-4'><select class='selectpicker' name='pharma'>";
                    $option = "";
                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= "<option value=" . $row['PharmaceuticalCompanyId'] . " selected>" . $row['PharmaName'] . "</option>";
                        }
                    }

                    $sql = "SELECT Name AS PharmaName, PharmaceuticalCompanyId
                    FROM PharmaceuticalCompany
                    WHERE PharmaceuticalCompany.PharmaceuticalCompanyId !=" . $oldpharma;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0 ) {
                        while($row = $result->fetch_assoc()) {
                            $option .= "<option value=" . $row['PharmaceuticalCompanyId'] . ">" . $row['PharmaName'] . "</option>";
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
            <input class="button" type="button" value="Back" onclick="location='table_drugs.php'">
        </form>
    </body>
</html>
