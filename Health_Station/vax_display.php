<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Vaccine History</title>
    <link rel="stylesheet" href="css/vax_display.css"/>
</head>
<body>

<div class="container">
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'health_station');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a patient ID is provided
if(isset($_GET['patient_Id'])) {
    $patient_id = $_GET['patient_Id'];

    // Retrieve patient information including vaccines, dates, and who administered
    $sql = "SELECT p.patient_Id, p.fName, p.mName, p.lName, v.vaccine_name, v.vaccination_date, s.Name AS administered_by
            FROM patient p
            LEFT JOIN vaccination_history v ON p.patient_Id = v.patientID
            LEFT JOIN staff s ON v.administered_by = s.employeeId
            WHERE p.patient_Id = '$patient_id'
            ORDER BY v.vaccination_date";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get patient name and ID from the first row
        $row = $result->fetch_assoc();
        $patient_fname = $row["fName"];
        $patient_mname = $row["mName"];
        $patient_lname = $row["lName"];
        $patient_id = $row["patient_Id"];

        // Output patient name and ID
        echo '<a href="PatientRecord.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png"></a>';
        echo "<h2>$patient_fname $patient_mname $patient_lname</h2>";
        echo "<h2>ID: $patient_id</h2>";

        // Output the table header
        echo "<table>";
        echo "<tr><th>Vaccine</th><th>Vaccination Date</th><th>Administered By</th></tr>";

        // Output data of each row
        do {
            echo "<tr>";
            echo "<td>" . $row["vaccine_name"] . "</td>";
            echo "<td>" . $row["vaccination_date"] . "</td>";
            echo "<td>" . $row["administered_by"] . "</td>";
            echo "</tr>";
        } while ($row = $result->fetch_assoc());

        echo "</table>";
    } else {
        echo "No records found for Patient ID: $patient_id";
    }
} else {
    echo "Patient ID not provided.";
}

// Close database connection
$conn->close();
?>
</div>

</body>
</html>
