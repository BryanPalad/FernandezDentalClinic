<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $username = "BRYAN";
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'fernandezdentalfdc@gmail.com';                 // SMTP username
    $mail->Password = 'soulfucker15';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('fernandezdentalfdc@gmail.com', 'Fernandez Dental Clinic');   // Add a recipient
    $mail->addAddress('paladbryanj@gmail.com');               // Name is optional
    $mail->addReplyTo('fernandezdentalfdc@gmail.com', 'Information');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account Information';
    $mail->Body    = 'You have created your account, Your username is'." <b>".$username."</b>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>