<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/phpmailer/PHPMailer.php";
require __DIR__ . "/phpmailer/SMTP.php";
require __DIR__ . "/phpmailer/Exception.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp-relay.brevo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '9c7582001@smtp-brevo.com'; 
    $mail->Password   = 'xsmtpsib-4c44dd45a58e60fd73f7cccd8cb7d52cc69de820bb8e1bfa413974086ca755e9-UOgzec06HLRGzFiT'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('stayade651@gmail.com', 'SMTP Test');
    $mail->addAddress('stayade651@gmail.com');

    $mail->Subject = "SMTP Test Email";
    $mail->Body    = "This is a test email via Brevo SMTP";

    if($mail->send()){
        echo "✔ Email sent successfully";
    } else {
        echo "❌ Failed but no exception";
    }

} catch (Exception $e) {
    echo "❌ ERROR: " . $mail->ErrorInfo;
}
