<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="css/Vaccination.css"/>
</head>
<body>
    
    <form method="post" action="VaccinationProcess.php">
        <a href="PatientRecord.php" class="back-button"><img class="back-button-img" src="images/left-arrow.png"></a>
        <h2>Update Vaccination</h2>

        <label for="patient_id">Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required autocomplete="off">

        <label for="vaccine_name">Vaccine Name:</label>
        <select id="vaccine_name" name="vaccine_name" required>
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

        <label for="vaccination_date">Vaccination Date:</label>
        <div class="input-group">
            <input type="date" id="vaccination_date" name="vaccination_date" required>
            <button type="button" id="resetButton">Set</button>
        </div>

        <input type="submit" value="Submit">
    </form>
    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
        // Get the date input element
        var dateInput = document.getElementById('vaccination_date');
        
        // Check if the date input already has a value set
        if (dateInput.value !== '') {
            // Use the previously set date
            dateInput.value = dateInput.value;
        } else {
            // Set the date input field to today's date
            var defaultDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
            dateInput.value = defaultDate;
        }
    });
    </script>
</body>
</html>
