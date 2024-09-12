<?php
session_start(); // Start the session to access session variables

// Database connection
$conn = new mysqli('localhost', 'root', '', 'health_station');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update vaccine history if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST["patient_id"];
    $vaccine_name = $_POST["vaccine_name"];
    $vaccination_date = $_POST["vaccination_date"];
    $administered_by = $_SESSION['employeeId']; // Get the logged-in staff ID from the session

    // Check if the patient has already received the selected vaccine
    $check_sql = "SELECT * FROM vaccination_history WHERE patientID = '$patient_id' AND vaccine_name = '$vaccine_name'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("This patient has already received the selected vaccine.");</script>';
        echo '<script>window.location.href = "Vaccination.php"; </script>';
    } else {
        // Prepare and bind statement, including administered_by field
        $stmt = $conn->prepare("INSERT INTO vaccination_history (patientID, vaccine_name, vaccination_date, administered_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $patient_id, $vaccine_name, $vaccination_date, $administered_by);

        try {
            if ($stmt->execute() === TRUE) {
                echo '<script>window.location.href = "Vaccination.php"; </script>';
            } 
        } catch (Exception $e) {
            echo '<script>alert("Patient does not EXIST!!!");</script>';
            echo '<script>window.location.href = "Vaccination.php"; </script>';
        }
        $stmt->close();
        $conn->close();
    }
}
?>
