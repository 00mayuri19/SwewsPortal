<?php
// Database connection setup
$host     = "localhost";
$dbname   = "mayurigoqul_contact_db";       // Your database name
$username = "mayurigoqul_user_info";        // Your database user
$password = "userinfo@123";     // Your database password

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Collect and sanitize form inputs
  $name    = htmlspecialchars($_POST["name"]);
  $email   = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);

  // Save to database
  $sql = "INSERT INTO users (name, email, password) 
          VALUES (:name,  :email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $password
  ]);

  // Send email to your address
  $to      = "mayuri@mayuri.goqul.com"; // CHANGE to your personal email
  $subject = "New Contact Form Submission";
  $body    = "Name: $name\nMobile: $mobile\nEmail: $email\nMessage:\n$message";
  $headers = "From: $email";

  if (mail($to, $subject, $body, $headers)) {
    echo "<div style='text-align:center; padding:20px; font-size:18px; color:green;'>✅ Thank you! Your message was sent successfully.</div>";
  } else {
    echo "Database saved, but email couldn't be sent.";
  }

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
