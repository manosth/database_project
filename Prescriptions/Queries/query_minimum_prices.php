<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../index.css">
        <script src="https://use.fontawesome.com/4f989e9bc6.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    </head>
    <body>
        <p class="big-text">Queries:Minimum Drug Prices</p>
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
            $sql = "SELECT Drug.Name AS Drug, Pharmacy.Name AS Pharmacy, Pharmacy.StreetName, Pharmacy.StreetNumber, MIN(Sell.Price) AS Min
            FROM Sell, Drug, Pharmacy
            WHERE Pharmacy.PharmacyId = Sell.PharmacyId AND Drug.DrugId = Sell.DrugId
            GROUP BY Sell.DrugId
            ORDER BY Drug.Name";
            $result = $conn->query($sql);

            echo "<center><table class='table'><tr><th colspan='5' style='background-color:#3c9f40'><center>Minimum Drug Prices</center></th></tr><tr><th>Drug</th><th>Pharmacy</th><th>Street Name</th><th>Street Number</th><th>Minimum Price</th></tr>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Drug"] . "</td><td>" . $row["Pharmacy"] . "</td><td>" . $row["StreetName"] . "</td><td>" . $row["StreetNumber"] . "</td><td>" . $row["Min"] . "</td></tr>";
                }
            }
            echo "</center></table>";

            $conn->close();
        ?>
        <br>
        <input class="button" type="button" value="Back" onclick="location='../index.php'" align="left">
    </body>
</html>
