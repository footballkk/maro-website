<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$message = $_POST['message'];

$conn = new mysqli('localhost', 'root', '', 'munira');

// Check for connection errors
if($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO eshetu (name, email, password, message) VALUES (?, ?, ?, ?)");

// Check if the statement preparation is successful
if ($stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

// Bind parameters
$stmt->bind_param('ssss', $name, $email, $password, $message);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Your message has been sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>
