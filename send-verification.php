<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer();                              // Passing `true` enables exceptions

if(isset($_GET['email']) && isset($_GET['code'])){

    try {
    //Server settings
    $username = "BRYAN";
    $email = $_GET['email'];
    $code = $_GET['code'];
    $mail_body = 'As part of the Fernandez Dental Clinic account registration process, we’ll need to verify your details by copying this code "'.$code.'"';

    //<a href="'. pathUrl(). 'verify-email.php?email='. $email .'&code='. $code .'" target="_blank">'.'Verify My E-mail'.'</a>';    
    
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'fernandezdentalfdc@gmail.com';                 // SMTP username
    $mail->Password = 'Bjgp09392735319282849121';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('fernandezdentalfdc@gmail.com', 'Fernandez Dental Clinic');   // Add a recipient
    //$mail->addReplyTo('fernandezdentalfdc@gmail.com', 'Information');
    $mail->addAddress($email);// Name is optional

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account Verification';
    $mail->Body    =  $mail_body;   
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    //echo $mail_body;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function pathUrl($dir = __DIR__){

    $root = "";
    $dir = str_replace('\\', '/', realpath($dir));

    //HTTPS or HTTP
    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

    //HOST
    $root .= '://' . $_SERVER['HTTP_HOST'];

    //ALIAS
    if(!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
    } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
    }

    $root .= '/';

    return $root;
}
?>