<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/stethoscope.png">
    <link rel="stylesheet" href="css/Dashboard.css">
    <title>Dashboard</title>
    
</head>
<body>

    <div class="dashboard">
        
    <a href="Homepage.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png" alt="Back"></a>
        <h2>Dashboard</h2>
        <div class="dashboard-item">
            <h3>Patient</h3>
            <?php
            // Establish connection to database
            $conn = new mysqli('localhost', 'root', '', 'health_station');

            // Check connection
            if($conn->connect_error){
                die("Connection Failed: " . $conn->connect_error);
            }

            // SQL query to count patients
            $sql = "SELECT COUNT(*) AS totalPatients FROM patient";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Total: " . $row["totalPatients"] . "</p>";
            } else {
                echo "<p>Total: 0</p>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
        <div class="dashboard-item">
            <h3>Staff</h3>
            <?php
            // Establish connection to database
            $conn = new mysqli('localhost', 'root', '', 'health_station');

            // Check connection
            if($conn->connect_error){
                die("Connection Failed: " . $conn->connect_error);
            }

            // SQL query to count staff
            $sql = "SELECT COUNT(*) AS totalStaff FROM staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Total: " . $row["totalStaff"] . "</p>";
            } else {
                echo "<p>Total: 0</p>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
    <div>
        <img class="Org" src="images/OrgChart.png">
    </div>
</body>
</html>
