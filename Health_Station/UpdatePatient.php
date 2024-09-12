<?php
// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_Id = $_POST['patient_Id'];
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $mName = $_POST['middle_name'];
    $Gender = $_POST['gender'];
    $Age = $_POST['age_months'];
    $Birthdate = $_POST['birthdate'];
    $Purok = $_POST['purok'];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'health_station');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update patient data
    $sql = "UPDATE patient SET fName='$fName', lName='$lName', mName='$mName', Gender='$Gender', Age='$Age', Birthdate='$Birthdate', Purok='$Purok' WHERE patient_Id=$patient_Id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: PatientRecord.php"); // Redirect to the patient list page
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    echo "Invalid request";
    exit;
}
?>
