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
                $phone = $_POST['phone'];
                $pharmaid = $_POST['pharma'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $stmt = $conn->prepare("UPDATE `PharmaceuticalCompany` SET `Name`=?, `PhoneNumber`=? WHERE `PharmaceuticalCompanyId`=?");
                $stmt->bind_param("sdd", $name, $phone, $pharmaid);
                $stmt->execute();

                $conn->close();
                header("Location:table_pharmas.php");
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
                    $pharmaid = $_POST['pharma'];
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    mysqli_set_charset($conn, "utf8");
                    $sql = "SELECT *
                    FROM PharmaceuticalCompany
                    WHERE PharmaceuticalCompany.PharmaceuticalCompanyId =" . $pharmaid;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $oldname = $row['Name'];
                        $oldphone = $row['PhoneNumber'];

                        $outp = "<p font-size='250%''>Name</p>";
                        $outp .= "<div class='col-xs-4'><input type='text' class='form-control' name='name' value='" . $oldname . "'></div><br><br>";
                        $outp .= "<p font-size='250%'>Phone Number</p>";
                        $outp .= "<div class='col-xs-4'><input type='number' class='form-control' name='phone' value='" . $oldphone . "'></div><br><br>";
                        $outp .= "<input type='hidden' class='form-control' name='pharma' value='" . $pharmaid . "'/>";
                        echo $outp;
                    }
                    $conn->close();
                }
            ?>
            <br>
            <input class='button' type='submit' name='update' value='Submit'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_pharmas.php'">
        </form>
    </body>
</html>
