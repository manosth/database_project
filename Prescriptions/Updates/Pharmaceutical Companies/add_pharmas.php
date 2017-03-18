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
                $name = $_POST['name'];
                $phone = $_POST['phone'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = 'INSERT INTO `PharmaceuticalCompany`(`Name`, `PhoneNumber`)
                VALUES ("' . $name . '","' . $phone .'")';
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_pharmas.php");
                exit;
            }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p font-size="250%">Name</p>
            <div class='col-xs-4'><input type="text" class="form-control" name="name"></div><br><br>
            <p font-size="250%">Phone Number</p>
            <div class='col-xs-4'><input type="number" class="form-control" name="phone"></div><br><br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_pharmas.php'">
        </form>
    </body>
</html>
