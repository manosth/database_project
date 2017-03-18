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
        <p class="big-text">Tables:Sales</p>
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
            $sql = "SELECT Pharmacy.PharmacyId, Drug.DrugId, Pharmacy.Name AS Pharmacy, Drug.Name AS Drug, Sell.Price
            FROM Sell, Pharmacy, Drug
            WHERE Pharmacy.PharmacyId = Sell.PharmacyId AND Drug.DrugId = Sell.DrugId";
            $result = $conn->query($sql);

            echo "<center><table class='table'><tr><th colspan='4' style='background-color:#3c9f40'><center>Sales</center></th></tr><tr><th>Sale ID (P/D)</th><th>Pharmacy</th><th>Drug</th><th>Price</th></tr>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["PharmacyId"] . $row["DrugId"] . "</td><td>" . $row["Pharmacy"] . "</td><td>" . $row["Drug"] . "</td><td>" . $row["Price"] . "</td></tr>";
                }
            }
            echo "</center></table>";

            $conn->close();
        ?>
        <br>
        <form method="post" action="upd_sales.php">
            <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                mysqli_set_charset($conn, "utf8");
                $sql = "SELECT Pharmacy.PharmacyId, Drug.DrugId, Pharmacy.Name AS Pharmacy, Drug.Name AS Drug
                FROM Sell, Pharmacy, Drug
                WHERE Pharmacy.PharmacyId = Sell.PharmacyId AND Drug.DrugId = Sell.DrugId";
                $result = $conn->query($sql);
                echo "<select class='selectpicker' name='sale'>";

                $option = "";
                if ($result->num_rows > 0 ) {
                    while($row = $result->fetch_assoc()) {
                        $option .= "<option value=" . $row['PharmacyId'] . $row['DrugId'] . ">" . $row['Pharmacy'] . ", " . $row['Drug'] . "</option>";
                    }
                }
                $option .= "</select>";
                $option .= "    <input class='button' type='submit' name='submit' value='Update'>";
                echo $option;

                $conn->close();
            ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Add" onclick="location='add_sales.php'" />
            <input class="button" type="button" value="Delete" onclick="location='del_sales.php'"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button" type="button" value="Back" onclick="location='../../index.php'">
        </form>
    </body>
</html>
