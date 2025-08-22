<?php
session_start();

// Database connection
$mysqli = new mysqli("localhost", "mayurigoqul_user_info", "userinfo@123", "mayurigoqul_contact_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Sanitize input
$email = $_POST['email'];
$password = $_POST['password'];

// Check credentials
$stmt = $mysqli->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    if (password_verify($password, $hashedPassword)) {
    // Login successful
    $_SESSION['email'] = $email;
    header("Location: dashboard.html");
    exit;
}
    } else {
        echo "<p class='error'>Incorrect password.</p>";
    }
else {
    echo "<p class='error'>Email not registered.</p>";
}

$stmt->close();
$mysqli->close();
?>