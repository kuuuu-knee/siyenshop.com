<?php
// Check if patientId is passed in the URL
if (isset($_GET['patient_Id'])) {
    $patientId = $_GET['patient_Id'];

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'health_station');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the data of the patient to be edited
    $sql = "SELECT * FROM patient WHERE patient_Id = $patientId";
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
    <title>Edit Patient</title>
    <link rel="stylesheet" href="css/EditPatient.css"/>
</head>
<body>
    
    <form action="UpdatePatient.php" method="POST">
    <a href="PatientRecord.php" class="back-button" ><img class="back-button-img" src="images/left-arrow.png"></a>
        <h1>Edit Patient</h1>
        <input type="hidden" name="patient_Id" value="<?php echo $row['patient_Id']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['fName']; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row['lName']; ?>" required>

        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['mName']; ?>" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" value="<?php echo $row['gender']; ?>" required>
            <option value="M"> Male</option>
            <option value="F">Female</option>
        </select>

        <label for="age_months">Age:</label>
        <input type="hidden" id="age_months" name="age_months" value="<?php echo $row['Age']; ?>" required>

        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" value="<?php echo $row['Birthdate']; ?>" required oninput="calculateAge()">

        <label for="purok">Purok:</label>
        <select class="purok" id="purok" name="purok" value="<?php echo $row['Purok']; ?>" required>
            <option value="1">Purok 1</option>
            <option value="2">Purok 2</option>
            <option value="3">Purok 3</option>
            <option value="4">Purok 4</option>
            <option value="5">Purok 5</option>
            <option value="6">Purok 6</option>
        </select>

        <input type="submit" value="Update">
    </form>
    <script>
        function calculateAge() {
            var today = new Date();
            var birthDate = new Date(document.getElementById("birthdate").value);
    
            // Calculate the difference in years
            var ageYears = today.getFullYear() - birthDate.getFullYear();
    
            // Calculate the difference in months
            var monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                ageYears--;
                monthDiff = 12 + monthDiff; // Adjusting for negative month difference
            }
    
            // Convert age to total months
            var ageMonths = ageYears * 12 + monthDiff;
    
            // Update the age input field
            document.getElementById("age_months").value = ageMonths + " months";
        }
    </script>
</body>
</html>
