<?php
// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'];
    $name = $_POST['Name'];
    $Position = $_POST['position'];
    $age = $_POST['Age'];
    $birthdate = $_POST['Birthdate'];
    $address = $_POST['Address'];
    $phone_number = $_POST['Phone_Number'];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'health_station');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update staff data
    $sql = "UPDATE staff SET Name='$name', position='$Position', Age='$age', Birthdate='$birthdate', Address='$address', Phone_Number='$phone_number' WHERE employeeId=$employeeId";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: DisplayStaffs.php"); // Redirect to the staff list page
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
