<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Collect form data
$name     = htmlspecialchars($_POST["name"]);
$email    = htmlspecialchars($_POST["email"]);
$phone    = htmlspecialchars($_POST["phone"]);
$education= htmlspecialchars($_POST["education_level"]);
$university = htmlspecialchars($_POST["university"]);
$experience = htmlspecialchars($_POST["experience"]);

///// SAVE TO DATABASE /////
$host     = "localhost";
$dbname   = "mayurigoqul_contact_db";       // Change with prefix
$username = "mayurigoqul_form_user";         // DB user
$password = "formuser@123";                 // Password

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO applications (name, email, phone, education_level, university, experience) 
          VALUES (:name, :email, :phone, :education_level, :university, :experience)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':phone' => $phone,
    ':education_level' => $education,
    ':university' => $university,
    ':experience' => $experience
  ]);
} catch (PDOException $e) {
  echo "❌ DB Error: " . $e->getMessage();
  exit;
}

///// EMAIL VIA PHPMailer /////
$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'gungun@mayuri.goqul.com';     // Gmail address
  $mail->Password   = 'gungun@1925';       // App password
  $mail->SMTPSecure = 'SMTP';
  $mail->Port       = 465;

  $mail->setFrom('gungun@mayuri.goqul.com', 'Form Submission');
  $mail->addAddress('mayuri@mayuri.goqul.com');      // Recipient

  $mail->isHTML(false);
  $mail->Subject = "New Application Received";
  $mail->Body    =
    "Name: $name\nEmail: $email\nPhone: $phone\n\n" .
    "Education Level: $education\nUniversity: $university\n\n" .
    "Experience:\n$experience";

  $mail->send();
  echo "✅ Submission received and emailed successfully!";
} catch (Exception $e) {
  echo "❌ Mailer Error: {$mail->ErrorInfo}";
}
?>
