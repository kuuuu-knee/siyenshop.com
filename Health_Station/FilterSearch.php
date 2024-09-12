<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'health_station');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve selected vaccine from the request
$vaccine = $_POST['vaccine'];


// Query to retrieve patient records based on the selected vaccine
$sql = "SELECT patient.*, vaccination_history.vaccine_name FROM patient LEFT JOIN vaccination_history ON patient.patient_id = vaccination_history.patientID WHERE vaccination_history.vaccine_name = '$vaccine'";
$result = $conn->query($sql);


// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<th>" . "Patient ID" . "</th>";
    echo "<th>" . "First Name" . "</th>";
    echo "<th>" . "Last Name" . "</th>";
    echo "<th>" . "Middle Name" . "</th>";
    echo "<th>" . "Gender" . "</th>";
    echo "<th>" . "Birthdate" . "</th>";
    echo "<th>" . "Age(in months)" . "</th>";
    echo "<th>" . "Purok" . "</th>";
    echo "<th>" . "Action" . "</th>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["patient_Id"] . "</td>";
        echo "<td>" . $row["fName"] . "</td>";
        echo "<td>" . $row["lName"] . "</td>";
        echo "<td>" . $row["mName"] . "</td>";
        echo "<td>" . $row["Gender"] . "</td>";
        echo "<td>" . $row["Birthdate"] . "</td>";
        echo "<td>" . $row["Age"] . "</td>";
        echo "<td>" . $row["Purok"] . "</td>";
        echo "<td class='button-cell'><button class='vaccination-button' onclick='viewVaccinationHistory(" . $row["patient_Id"] . ")'>View History</button><a class='edit-button' onclick='Edit(" . $row["patient_Id"] . ")'>Edit</a><a class='delete-button' onclick='deleteRow(" . $row["patient_Id"] . ")'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    // No records found
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

// Close the database connection
$conn->close();
?>
