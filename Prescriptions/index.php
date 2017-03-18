<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="index.css">
        <script src="https://use.fontawesome.com/4f989e9bc6.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    </head>
    <body>
        <center><p class="big-text">Prescriptions-R-X</p></center>
        <div class="background">
        </div>
        <br>
        <center><p>At Prescriptions-R-X we value you, our customers. We try to bring you the best possible services, at only a fraction of the price of our competitors. This application is an interface to interact with your database. We provide various links and interfaces for you to interact with your database: you can enter, edit, or delete information from the tables, you can navigate the two views you requested, and you can see a variety of queries, as per your request. To continue, simply follow one of the links below.</p></center>

        <div class="container-fluid">
            <div class="row" style="padding: 10px">
                <div class="col-sm-4">
                    <h3><i class="fa fa-flask"></i>Views</h3>
                    <p>We are providing you the two requested views for your bussiness. The first is a non editable view that allows you to see who has been prescribed a drug, what drug has been prescribed, and who prescribed it. The second one is an editable biew of people and their specializations. Please free to use them and provide feedback, we're eager to see how all this pans out!
                    <br>
                    <br>
                    You can find the first view <a href="Views/Drugs/view_drugs.php">here</a>.
                    <br>
                    And the second one <a href="Views/Patients/view_patients.php">here</a>.
                    </p>
                </div>

                <div class="col-sm-4">
                    <h3><i class="fa fa-map"></i>Queries</h3>
                    <p>Here you can find queries. You can find various queries here:
                    <br>
                    <br>
                    • <a href="Queries/query_patients_drugs.php">Here</a> you can find a query for drug names, given a patient ID.
                    <br>
                    • <a href="Queries/query_pharmacies_Mylan.php">Here</a> you can find a query for pharmacies that have a contract with a very well known pharmaceutical company, Mylan.
                    <br>
                    • <a href="Queries/query_companies_drugs.php">Here</a> you can find a query for the drugs sold by every company.
                    <br>
                    • <a href="Queries/query_average_prices.php">Here</a> you can find a query for the average price of each drug.
                    <br>
                    • <a href="Queries/query_minimum_prices.php">Here</a> you can find a query for the minimum price of each drug and where to get it.
                    <br>
                    • <a href="Queries/query_pharmacies_in_Athens.php">Here</a> you can find a query for the pharmacies in the town of Athens.
                    <br>
                    • <a href="Queries/query_experienced_heart_surgeons.php">Here</a> you can find a query for experienced doctors specialized in Heart Surgery.
                    <br>
                    • <a href="Queries/query_companies_clients.php">Here</a> you can find a query for the clients of each pharmaceutical company.
                    <br>
                    • <a href="Queries/query_patients_experienced.php">Here</a> you can find a query for the patients of experienced doctors.
                    <br>
                    • <a href="Queries/query_expensive_drugs.php">Here</a> you can find a query for expensive drugs.
                    </p>
                </div>

                <div class="col-sm-4">
                    <h3><i class="fa fa-heartbeat"></i>Updates</h3>
                    <p>Here you can view and update every table in your database. These are in no particular order. You simply choose one, click the corresponding hypertext and decide whether you'd like to update, insert, or delete. There will be buttons for whatever you wish to do. Here are the tables you can update:
                    <a href="Updates/Patients/table_patients.php">Patients</a>,
                    <a href="Updates/Doctors/table_doctors.php">Doctors</a>,
                    <a href="Updates/Drugs/table_drugs.php">Drugs</a>,
                    <a href="Updates/Pharmacies/table_pharmacies.php">Pharmacies</a>,
                    <a href="Updates/Pharmaceutical Companies/table_pharmas.php">Pharmaceutical Companies</a>,
                    <a href="Updates/Prescriptions/table_prescriptions.php">Prescriptions</a>,
                    <a href="Updates/Sales/table_sales.php">Sales</a>,
                    <a href="Updates/Contracts/table_contracts.php">Contracts</a>.
                    </p>
                </div>
            </div>
        </div>

        <center>
            <p><font size="-1">Made with <i class="fa fa-heart-o"></i> by Emmanouil Theodosis</font></p>
        <center>
    </body>
</html>
