<?php
// Database connection settings
$servername = "localhost"; 
$username = "root";
$password = "";        
$dbname = "project"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (!preg_match('/^(\+?[1-9]\d{0,3})?(\s)?\d{10}$/', $phone)) {
        echo "Invalid phone number format.";
        exit; // Stop further processing
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL query to insert the data
    $sql = "INSERT INTO customer (phone, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $phone, $hashed_password); // Bind the parameters (phone, hashed password)

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            if ($conn->errno == 1062) {
                echo "Error: Phone number already exists.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}

$conn->close();
?>
