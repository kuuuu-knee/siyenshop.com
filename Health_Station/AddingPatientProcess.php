<?php
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $mName = $_POST['middle_name'];
    $Gender = $_POST['gender'];
    $Birthdate = $_POST['birthdate'];
    $Age = $_POST['age_months'];
    $Purok = $_POST['purok'];

    $conn = new mysqli('localhost', 'root', '', 'health_station');

    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT INTO patient(fName, lName, mName, Gender, Birthdate, Age, Purok)
                                VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssis", $fName, $lName, $mName, $Gender, $Birthdate, $Age, $Purok);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        
        echo '<script>window.location.href = "AddingPatient.html"; </script>';
    }


?>