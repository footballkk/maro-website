<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'munira');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM eshetu WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debugging: Output values
        var_dump($password); // User-entered password
        var_dump($user['password']); // Fetched hashed password

        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['name'];
            header("Location: index.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this name.";
    }

    $stmt->close();
}

$conn->close();
?>
