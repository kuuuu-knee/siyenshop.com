<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="images/stethoscope.png">
<link href="css/PatientRecord.css" rel="stylesheet"/>
<title>Patient Record</title>

</head>
<body>
    <div class="sidebar">
    <ul>
        <h1 class="title-font">Patient Record</h1>
        <li><a href="AddingPatient.html">Add Patient</a></li>
        <li><a href="Vaccination.php">Update Vaccination</a></li>
    </ul>
    </div>

    <div class="content">
    <a href="Homepage.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png"></a>
    <h1>List of Patients</h1>

    <div class="filter-container">

        <label class="filter-purok" for="purokFilter"></label>
        <select class="filter-input" id="purokFilter" onchange="filterPurokPatients()">
            <option value="">Filter By Purok</option>
            <option value="1">Purok 1</option>
            <option value="2">Purok 2</option>
            <option value="3">Purok 3</option>
            <option value="4">Purok 4</option>
            <option value="5">Purok 5</option>
            <option value="6">Purok 6</option>
        </select>

        <label class="filter-gender" for="genderFilter"></label>
        <select class="filter-input" id="genderFilter" onchange="filterGenderPatients()">
            <option value="">Filter By Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
        
        <label class="filter-vaccine" for="vaccineFilter"></label>
        <select class="filter-input" id="vaccineFilter" onchange="filterPatients()">
            <option value="reset">Filter By Vaccine</option>
            <option value="DPT_HiB_HepB_1st_Dose">DPT HiB HepB 1st Dose</option>
            <option value="DPT_HiB_HepB_2nd_Dose">DPT HiB HepB 2nd Dose</option>
            <option value="DPT_HiB_HepB_3rdDose">DPT HiB HepB 3rd Dose</option>
            <option value="OPV_1stDose">OPV 1st Dose</option>
            <option value="OPV_2ndDose">OPV 2nd Dose</option>
            <option value="OPV_3rdDose">OPV 3rd Dose</option>
            <option value="PCV_1st_Dose">PCV 1st Dose</option>
            <option value="PCV_2nd_Dose">PCV 2nd Dose</option>
            <option value="PCV_3rd_Dose">PCV 3rd Dose</option>
            <option value="IPV">IPV</option>
        </select>
        <input type="text" class="search-input" id="searchInput" onkeyup="searchTable()" placeholder="Search for Last Name.." title="Type in a Patient ID">
    </div>
    <table id="patientTable">
        <tr>
            <th>Patient ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Name</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Age(in months)</th>
            <th>Purok</th>
            <th>Action</th>
        </tr>
        <?php
            // Connect to database
            $conn = new mysqli('localhost', 'root', '', 'health_station');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Retrieve data from database
            $sql = "SELECT * FROM patient";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
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
                $sql = "ALTER TABLE patient AUTO_INCREMENT = 1";
                $result = $conn->query($sql);
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            // Close database connection
            $conn->close();
        ?>
    </table>
    </div>
    <script>
    function viewVaccinationHistory(patient_Id) {
        // Redirect to vaccination history page with patientId parameter
        window.location.href = "vax_display.php?patient_Id=" + patient_Id;
    }

    function deleteRow(patient_Id) {
        if (confirm("Are you sure you want to delete this record?")) {
            // Send an AJAX request to delete the row and associated vaccination history
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Reload the page after successful deletion
                        window.location.reload();
                    } else {
                        // Handle error
                        alert("Error: " + xhr.responseText);
                    }
                }
            };
            xhr.open("POST", "DeletePatient.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("patient_Id=" + patient_Id);
        }
    }

    function Edit(patient_Id) {
        // Redirect to vaccination history page with patientId parameter
        window.location.href = "EditPatient.php?patient_Id=" + patient_Id;
    }

    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("patientTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header
            td = tr[i].getElementsByTagName("td")[2]; // Change index to match the column where patient Ladt Name is
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

    function filterPatients() {
        var vaccine = document.getElementById("vaccineFilter").value;
        if (vaccine === "reset") {
            // Reset the filter by reloading the page
            location.reload();
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        document.querySelector("table").innerHTML = xhr.responseText;
                    } else {
                        // Handle error
                        alert("Error: " + xhr.responseText);
                    }
                }
            };
            xhr.open("POST", "FilterSearch.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("vaccine=" + vaccine);
        }
    }
    function filterGenderPatients() {
        var gender = document.getElementById("genderFilter").value;
        if (gender === "reset") {
            // Reset the filter by reloading the page
            location.reload();
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        document.querySelector("table").innerHTML = xhr.responseText;
                    } else {
                        // Handle error
                        alert("Error: " + xhr.responseText);
                    }
                }
            };
            xhr.open("POST", "FilterSearchGender.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("gender=" + gender);
        }
    }
    function filterPurokPatients() {
        var purok = document.getElementById("purokFilter").value;
        if (purok === "reset") {
            // Reset the filter by reloading the page
            location.reload();
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        document.querySelector("table").innerHTML = xhr.responseText;
                    } else {
                        // Handle error
                        alert("Error: " + xhr.responseText);
                    }
                }
            };
            xhr.open("POST", "FilterSearchPurok.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("purok=" + purok);
        }
    }
</script>
</body>
</html>
