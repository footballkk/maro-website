<?php
$Name = $_POST['name'];
$Email = $_POST['email'];
$Password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

$conn = new mysqli('localhost','root','','munira');

if($conn -> connect_error){
    die ('connection failed: ' .$conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn -> prepare("INSERT INTO eshetu(name, email, password) VALUES (?, ?, ?)");

if ($stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

// Bind parameters and execute
$stmt -> bind_param("sss", $Name, $Email, $hashedPassword);

if ($stmt->execute()) {
    echo "You have registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
