<?php
session_start(); // Start session to access session variables

// Database connection parameters
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Sandy@45#';
$dbName = "GreenLeafNursery";

// Connect to the database
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the user is logged in, retrieve their email from the session or a cookie
$email = $_SESSION['email']; // or $_COOKIE['email'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT first_name, last_name, email, address FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $address);
$stmt->fetch();
$stmt->close();
$conn->close();

// Return data as JSON
echo json_encode(array(
    'first_name' => $firstName,
    'last_name' => $lastName,
    'email' => $email,
    'address' => $address
));
?>
