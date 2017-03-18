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
        <p class="big-text">Tables:Pharmaceutical Companies</p>
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
            $sql ="SELECT * FROM PharmaceuticalCompany";
            $result = $conn->query($sql);

            echo "<center><table class='table'><tr><th colspan='3' style='background-color:#3c9f40'><center>Pharmaceutical Companies</center></th></tr><tr><th>Pharmaceutical Company ID</th><th>Name</th><th>Phone Number</th></tr>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["PharmaceuticalCompanyId"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["PhoneNumber"] . "</td></tr>";
                }
            }
            echo "</center></table>";

            $conn->close();
        ?>
        <br>
        <form method="post" action="upd_pharmas.php">
            <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT PharmaceuticalCompanyId, Name FROM PharmaceuticalCompany";
                $result = $conn->query($sql);
                echo "<select class='selectpicker' name='pharma'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['PharmaceuticalCompanyId'] . ">" . $row['Name'] . "</option>";
                    }
                }
                $option .= "</select>";
                $option .= "    <input class='button' type='submit' name='submit' value='Update'>";
                echo $option;

                $conn->close();
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Add" onclick="location='add_pharmas.php'" />
            <input class="button" type="button" value="Delete" onclick="location='del_pharmas.php'"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='../../index.php'">
        </form>
    </body>
</html>
