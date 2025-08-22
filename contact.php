<?php
// Database connection setup
$host     = "localhost";
$dbname   = "mayurigoqul_contact_db";       // Your database name
$username = "mayurigoqul";        // Your database user
$password = "formuser@123";     // Your database password

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Collect and sanitize form inputs
  $name    = htmlspecialchars($_POST["name"]);
  $mobile  = htmlspecialchars($_POST["mobile"]);
  $email   = htmlspecialchars($_POST["email"]);
  $message = htmlspecialchars($_POST["message"]);

  // Save to database
  $sql = "INSERT INTO contacts (name, mobile, email, message) 
          VALUES (:name, :mobile, :email, :message)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':mobile' => $mobile,
    ':email' => $email,
    ':message' => $message
  ]);

  // Send email to your address
  $to      = "mayurigupta303@gmail.com"; // CHANGE to your personal email
  $subject = "New Contact Form Submission";
  $body    = "Name: $name\nMobile: $mobile\nEmail: $email\nMessage:\n$message";
  $headers = "From: $email";

  if (mail($to, $subject, $body, $headers)) {
    echo "Submission received. Thank you!";
  } else {
    echo "Database saved, but email couldn't be sent.";
  }

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>




<?php
// Database connection setup
$host     = "localhost";
$dbname   = "mayurigoqul_contact_db";       // Your database name
$username = "mayurigoqul_form_user";        // Your database user
$password = "formuser@123";     // Your database password

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Collect and sanitize form inputs
  $name    = htmlspecialchars($_POST["name"]);
  $mobile  = htmlspecialchars($_POST["mobile"]);
  $email   = htmlspecialchars($_POST["email"]);
  $message = htmlspecialchars($_POST["message"]);

  // Save to database
  $sql = "INSERT INTO contacts (name, mobile, email, message) 
          VALUES (:name, :mobile, :email, :message)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':mobile' => $mobile,
    ':email' => $email,
    ':message' => $message
  ]);

  // Send email to your address
  $to      = "mayurigupta303@gmail.com"; // CHANGE to your personal email
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










