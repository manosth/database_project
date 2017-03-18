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
                $todelete = $_POST['drug'];

                $servername = "localhost";
                $username = "root";
                $password = NULL;
                $dbname = "Prescriptions-R-X";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "DELETE FROM Drug WHERE DrugId=" . $todelete;
                $result = $conn->query($sql);

                $conn->close();
                header("Location:table_drugs.php");
                exit;
            }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p font-size="250%">Delete</p>
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
                $sql = "SELECT DrugId, Name FROM Drug";
                $result = $conn->query($sql);

                $option = "<select class='selectpicker' name='drug'>";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['DrugId'] . ">" . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select>";

                $conn->close();
                echo $option;
            ?>
            <br>
            <br>
            <input class="button" type="submit" name="submit" value="Submit">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='table_drugs.php'">
        </form>
    </body>
</html>
