<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/stethoscope.png">
    <title>Staff Data</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #a3b18a;
        }
        .sidebar {
            height: 100vh;
            width: 100px;
            background-color: #588157;
            position: fixed;
            left: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li a {
            font-size: large;
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
        }
        .sidebar li a:hover {
            background-color: #ddd;
            color: black;
        }
        .content {
            margin-left: 100px; /* Adjust based on the width of the sidebar */
            padding: 20px;
        }
        .title-font {
            color: white;
            text-align: center;
        }
        .back-button-img {
            height: 30px;
            width: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            color: white;
        }
        th, td {
            border: 2px solid black;
            font-size: large;
            padding: 7px;
            text-align: center;
        }
        th {
            background-color: #588157;
            text-align: center;
        }
        .button-cell {
            text-align: center;
        }
        .delete-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .edit-button{
            background-color: green;
            color: white;
            border: none;
            padding: 5px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        h1 {
            color: white;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .search-input {
            vertical-align: middle;
            height: 30px;
            width: 200px;
            font-size: large;
            margin-left: 1179px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="sidebar">
</div>

<div class="content">
    <a href="Homepage.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png" alt="Back"></a>
    <h1>List of Staff</h1>
    <input type="text" class="search-input" id="searchInput" onkeyup="searchTable()" placeholder="Search for Employee ID.." title="Type in an Employee ID">

    <table>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Age</th>
            <th>Birthdate</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Action</th>
        </tr>
        <?php
            // Connect to database
            $conn = new mysqli('localhost', 'root', '', 'health_station');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve data from database
            $sql = "SELECT * FROM staff";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["employeeId"] . "</td>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Position"] . "</td>";
                    echo "<td>" . $row["Age"] . "</td>";
                    echo "<td>" . $row["Birthdate"] . "</td>";
                    echo "<td>" . $row["Address"] . "</td>";
                    echo "<td>" . $row["Phone_Number"] . "</td>";
                    echo "<td class='button-cell'><a class='edit-button' onclick='Edit(" . $row["employeeId"] . ")'>Edit</button></td>";
                    echo "</tr>";
                }
            } else {
                $sql = "ALTER TABLE staff AUTO_INCREMENT = 1";
                $result = $conn->query($sql);
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            // Close database connection
            $conn->close();
        ?>
    </table>
</div>
<script>
    function Edit(employeeId) {
        // Redirect to vaccination history page with patientId parameter
        window.location.href = "EditStaff.php?employeeId=" + employeeId;
    }

    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change index to match the column where employee ID is
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    
</script>
</body>
</html>
