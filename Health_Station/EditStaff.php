<?php
// Check if employeeId is passed in the URL
if (isset($_GET['employeeId'])) {
    $employeeId = $_GET['employeeId'];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'health_station');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the data of the staff to be edited
    $sql = "SELECT * FROM staff WHERE employeeId = $employeeId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
        exit;
    }
    // Close database connection
    $conn->close();
} else {
    echo "Invalid request";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/stethoscope.png">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="css/EditStaff.css"/>
</head>
<body>
    
    <form action="UpdateStaff.php" method="POST">
    <a href="DisplayStaffs.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png"></a>
        <h1>Edit Staff</h1>
        <input type="hidden" name="employeeId" value="<?php echo $row['employeeId']; ?>">
        <label for="Name">Name:</label>
        <input type="text" id="Name" name="Name" value="<?php echo $row['Name']; ?>" required>
        <label class="position" for="position">Position:</label>
            <select class="position" id="position" name="position" value="<?php echo $row['Position']; ?>" required>
                <option value="Midwife">Midwife</option>
                <option value="Nurse">Nurse</option>
                <option value="BNS">Barangay Nutrion Scholar</option>
                <option value="BHW">Barangay Health Worker</option>
            </select>
        <label for="Age"></label>
        <input type="hidden" id="Age" name="Age" value="<?php echo $row['Age']; ?>" required>
        <label for="Birthdate">Birthdate:</label>
        <input type="date" id="Birthdate" name="Birthdate" value="<?php echo $row['Birthdate']; ?>" required oninput="calculateAge()">
        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" value="<?php echo $row['Address']; ?>" required>
        <label for="Phone_Number">Phone Number:</label>
        <input type="text" id="Phone_Number" name="Phone_Number" value="<?php echo $row['Phone_Number']; ?>" required>
        <input type="submit" value="Update">
    </form>
    <script>
        function calculateAge() {
            var today = new Date();
            var birthDate = new Date(document.getElementById("Birthdate").value);
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById("Age").value = age;
        }
    </script>
</body>
</html>
