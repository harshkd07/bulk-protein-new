<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $recipient_email = $_POST['recipient_email'];
  $user_name = $_POST['newsletter_name'];
  $user_email = $_POST['newsletter_email'];
  $user_company = $_POST['newsletter_company'];
  $user_phone = $_POST['newsletter_phone'];
  $user_web = $_POST['newsletter_web'];
  $user_country = $_POST['newsletter_country'];

  $subject = 'New Newsletter Subscription';
  $message = "Name: $user_name\nEmail: $user_email\nCompany: $user_company\nPhone: $user_phone\nWebsite: $user_web\nCountry: $user_country";

  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com';  // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username@example.com'; // Replace with your SMTP username
    $mail->Password = 'your_password'; // Replace with your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom($user_email, $user_name);
    $mail->addAddress($recipient_email);

    //Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>
