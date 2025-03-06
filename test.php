<?php
$userEnteredPassword = "chamo4974";
$storedHash = "$2y$10$8MJxv2a.NYXr3W4Y7c/I8eyJ9/9O0k63GyfgVaKtzIS";

if (password_verify($userEnteredPassword, $storedHash)) {
    echo "Password is valid!";
} else {
    echo "Invalid password.";
}
?>
