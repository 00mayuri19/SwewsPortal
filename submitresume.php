<?php
// Database connection
$conn = new mysqli('localhost', 'mayurigoqul', 'mayuri@123', 'resume_db');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Form data
$name   = $_POST['name'];
$email  = $_POST['email'];
$skills = $_POST['skills'];

// Handle file upload
$target_dir = "uploads/";
if (!is_dir($target_dir)) mkdir($target_dir, 0755);
$target_file = $target_dir . basename($_FILES["resume"]["name"]);

if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
  $stmt = $conn->prepare("INSERT INTO resumes (name, email, skills, resume_file) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $skills, $target_file);
  $stmt->execute();
  echo "<h3>✅ Resume submitted successfully!</h3>";
  $stmt->close();
} else {
  echo "<h3>❌ Failed to upload resume.</h3>";
}

$conn->close();
?>
