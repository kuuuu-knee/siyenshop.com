<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if patient_Id is set and not empty
if (isset($_POST['patient_Id']) && !empty($_POST['patient_Id'])) {
    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'health_station');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Prepare a delete statement for the vaccination_history table
        $stmt1 = $conn->prepare("DELETE FROM vaccination_history WHERE patientID = ?");
        $stmt1->bind_param("i", $_POST['patient_Id']);

        // Execute the delete statement for vaccination_history
        if (!$stmt1->execute()) {
            throw new Exception("Error deleting from vaccination_history: " . $stmt1->error);
        }

        // Prepare a delete statement for the patient table
        $stmt2 = $conn->prepare("DELETE FROM patient WHERE patient_Id = ?");
        $stmt2->bind_param("i", $_POST['patient_Id']);

        // Execute the delete statement for patient
        if (!$stmt2->execute()) {
            throw new Exception("Error deleting from patient: " . $stmt2->error);
        }

        // Commit the transaction
        $conn->commit();

        // Delete successful
        echo "Record deleted successfully";
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $conn->rollback();
        // Output the error message
        echo "Error: " . $e->getMessage();
    }

    // Close statements and database connection
    $stmt1->close();
    $stmt2->close();
    $conn->close();
} else {
    // If patient_Id is not set or empty, display an error message
    echo "Invalid PatientId";
}
?>
