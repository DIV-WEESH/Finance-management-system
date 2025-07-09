<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $age = (int)$_POST['age'];
    $sex = $conn->real_escape_string($_POST['sex']);
    $customertype = $conn->real_escape_string($_POST['customertype']);

    // SQL query to insert data into the new_account table
    $sql = "INSERT INTO new_account (first_name, last_name, phone_no, age, sex, customer_type) 
            VALUES ('$firstname', '$lastname', '$phone', $age, '$sex', '$customertype')";

    if ($conn->query($sql) === TRUE) {
        echo "New account created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
