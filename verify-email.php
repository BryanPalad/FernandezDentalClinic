<?php
include ('assets/conn/dbconnect.php');

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

<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Account Verification - Fernandez Dental Clinic</title>
    </head>
    <body>
        <style type="text/css">
            .emailerror
            {
                text-align: center;
                margin-top: 250px;
                font-size: 20px;
                font-family: Times New Roman;
                text-shadow: 2px 2px 5px red;
            }
            .emailsuccess
            {
                text-align: center;
                margin-top: 250px;
                font-size: 20px;
                font-family: Times New Roman;
                text-shadow: 2px 2px 5px green;
            }
            body
            {
                background-image: url('assets/img/slide_smile3.jpg');
                background-size: cover ;
                background-repeat: no-repeat;
                background-size: 1400px 700px;
            }
        </style>
        <?php 
            if(isset($_GET['email']) && isset($_GET['code'])){
                $email = $_GET['email'];
                $code = $_GET['code'];
                
                $result = mysqli_query($con,"SELECT * FROM verify WHERE email ='$email' AND code = '$code'");

                if(mysqli_num_rows($result)==0)
                {
                    echo '<div class="emailerror">Email or code<br> is invalid. Please try again...</div>';
                }
                else
                {
                    $step1 = mysqli_query($con,"DELETE FROM verify WHERE email ='$email' AND code = '$code'");
                    $step2 = mysqli_query($con,"UPDATE patientinfo SET verified = 1 WHERE patientEmail = '$email'");

                    echo '<div class="emailsuccess">Email Address has been verified!<br>You can now login to your account: <a href="'.pathUrl() .'">GO BACK TO OUR SITE</a></div>';
                }
            }
            else{
                header("Location:".pathUrl());
            }
        ?>
    </body>
</html>

