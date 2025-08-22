<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if(isset($_POST['submitform'])){

    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    
try {
    //Server settings                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mayurigupta303@gmail.com.com';                     //SMTP username
    $mail->Password   = 'znthnlmadejhqvsm';   
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    
    //SMTP password
    //SMTP password
    //Recipients
    $mail->setFrom('mayurigupta303@gmail.com', 'contact-form');
    $mail->addAddress('mayurigupta303@gmail.com', 'Joe User');     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<h3>Here is a new enquiry!</h3>
    <h4>name:'$name'</h4>
    <h4>mobile:'$mobile'</h4>
    <h4>email:'$email'</h4>
    ';
   if( $mail->send();){
$_SESSION['status']="Thankyou for your message!";
   header("Location: {$_SERVER["HTTP_REFRER"]}");
    exit(0);
   }

   else{
    $_SESSION['status']="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   header("Location: {$_SERVER["HTTP_REFRER"]}");
    exit(0);
   }
   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
} else{
    header('Location: index.php');
    exit(0);
}