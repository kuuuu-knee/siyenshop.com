<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'health_station');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve gender filter value
$purok = $_POST['purok'];

// Construct the SQL query with gender filter
$sql = "SELECT * FROM patient WHERE 1=1";

if (!empty($purok)) {
    $sql .= " AND Purok = '$purok'";
}

$result = $conn->query($sql);

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

    while ($row = $result->fetch_assoc()) {
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
    echo "<tr><td colspan='9'>No records found</td></tr>";
}

// Close database connection
$conn->close();
?>
