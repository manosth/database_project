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
        <p class="big-text">Queries:Pharmaceutical Companies & Drugs</p>
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
            $sql = "SELECT Drug.Name AS DrugName, PharmaceuticalCompany.Name AS CompanyName
            FROM Drug, PharmaceuticalCompany
            WHERE Drug.PharmaceuticalCompanyId = PharmaceuticalCompany.PharmaceuticalCompanyId
            GROUP BY PharmaceuticalCompany.Name";
            $result = $conn->query($sql);

            echo "<center><table class='table'><tr><th colspan='2' style='background-color:#3c9f40'><center>Pharmaceutical Companies & Drugs</center></th></tr><tr><th>Pharmaceutical Company</th><th>Drug</th></tr>";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["CompanyName"] . "</td><td>" . $row["DrugName"] . "</td></tr>";
                }
            }
            echo "</center></table>";

            $conn->close();
        ?>
        <br>
        <input class="button" type="button" value="Back" onclick="location='../index.php'" align="left">
    </body>
</html>
