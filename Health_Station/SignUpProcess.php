<?php

$VerificationCode = "BGHealthStation2020";

$Password = $_POST['password'];
$Name = $_POST['userName'];
$Position = $_POST['position'];
$Age = $_POST['age'];
$Birthdate = $_POST['birthdate'];
$Address = $_POST['address'];
$Phone_Number = $_POST['phone'];
$Verification_Code = $_POST['code'];

if($Verification_Code == null){
    echo '<script> 
            window.location.href = "index.php";
        </script>'; 
}
if ($Verification_Code != $VerificationCode) {
    echo '<script>
            alert("Invalid Verification Code. Consult your Station Head.");
            window.location.href = "SignUP.html";
          </script>';
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'health_station');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // No need to check for existing employee ID since it's not part of the form data.
    // Assuming unique email or username could be used for such checks if required.

    $stmt = $conn->prepare("INSERT INTO staff (Password, Name, Position, Age, Birthdate, Address, Phone_Number)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissi", $Password, $Name, $Position, $Age, $Birthdate, $Address, $Phone_Number);
    $stmt->execute();

    // Fetch the ID of the newly created user
    $employeeID = $conn->insert_id;

    $stmt->close();
    $conn->close();

    // Alert for successful sign up with the new Employee ID
    echo '<script>
            alert("Sign Up successful. Your Employee ID is ' . $employeeID . '");
            window.location.href = "index.php";
          </script>';
}

?>
