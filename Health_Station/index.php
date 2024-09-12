<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/stethoscope.png">
    <link rel="stylesheet" href="css/index.css">
    <title>Login</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #588157;
}

.center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
}

.container {
    display: flex; 
    flex-direction: row; /* Default to row for larger screens */
    justify-content: space-between;
    align-items: center; 
    width: 650px; 
    background-color: #a3b18a;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow */
    color: white;
    font-size: large;
}

.form-group {
    margin-bottom: 10px;
    margin-top: 10px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="password"] {
    width: calc(100% - 15px); /* Adjusted width for centered inputs */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-left: -5px; 
    background-color: #588157;
    font-size: large;
    color: white;
}

input[type="submit"] {
    background-color: #0077b6;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: large;
    width: 93%;
    margin-top: 15px; 
    margin-left: -5px;
}

input[type="submit"]:hover {
    background-color: black;
}

img {
    height: 330px;
}

h3 {
    margin-left: -5px;
}

h1 {
    margin-right: 15px;
}

    </style>
<body>
    <div class="center">
        <div class="container">
            <img src="images/animation.png" alt="Image" style="width: 350px;"> <!-- Added image -->
            <div class="divider"></div>
            <form id="patientForm" method="post" action="LoginProcess.php">  <!-- dito manggagaling ang mga input na pupunta sa LoginProcess.php -->
                <center><h1>Banuang Gurang <br> Health Station</h1></center> 
                <div class="form-group">
                    <label for="role">Employee ID:</label>
                    <input type="text" id="employee_Id" name="employee_Id" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required autocomplete="off">
                </div>
                <input type="submit" value="Login">
                <center><h3>New Here? <a href="SignUP.html">SignUp</a></h3></center> <!-- dito ang maga redirect sa SignUp page pag kaylangan mag SignUP -->
            </form>
        </div>
    </div>
</body>
</html>
