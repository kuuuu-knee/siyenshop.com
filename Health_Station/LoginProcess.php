<?php
session_start(); // Start session (if not already started)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employee_Id'];
    $Password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'health_station');

    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Modify the SQL query to fetch the name as well
        $stmt = $conn->prepare("SELECT employeeId, Password, Name FROM staff WHERE employeeId = ?");
        $stmt->bind_param("i", $employeeID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // If employee ID is valid, fetch the row
            $row = $result->fetch_assoc();
            if ($row['Password'] == $Password) {
                // If password matches, store employee name in session and redirect to homepage
                $_SESSION['employeeId'] = $employeeID;
                $_SESSION['employeeName'] = $row['Name'];
                header("Location: Homepage.php");
                exit();
            } else {
                // If password does not match, display password error message
                echo '<script>alert("Password does not match. Check your Password.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            }
        } elseif ($result->num_rows == 0) {
            // If no match found for the employee ID, display ID error message
            echo '<script>alert("Employee ID does not match. Check your Employee ID.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            // If multiple matches found for the employee ID, display general error message
            echo '<script>alert("Multiple records found for the same Employee ID. Please contact the administrator.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }

        $stmt->close();
        $conn->close();
    }
}
?>
