<?php
include ('assets/conn/dbconnect.php');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// include_once 'assets/conn/server.php';
?>
<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}
if (isset($_POST['login']))
{
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$logerror = "";

$res = mysqli_query($con,"SELECT * FROM patientinfo WHERE username ='$icPatient' or patientEmail = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

$logerror = "Invalid Username/Password";
if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['username'];

header("Location: patient/patient.php");

} else
{
    $logerror = "*Invalid Username / Password*";
}
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
$patientFirstName = $_POST['patientFirstName'];
$patientLastName  = $_POST['patientLastName'];
$patientEmail     = $_POST['patientEmail'];
$codenumber    = $_POST['codeNumber'];
$password         = $_POST['pass'];
$conpassword = $_POST['conpass'];
$month            = $_POST['month'];
$day              = $_POST['day'];
$year             = $_POST['year'];
$patientDOB       = $year . "-" . $month . "-" . $day;
$patientGender =$_POST['patientGender'];
$status = $_POST['status'];
$address = $_POST['address'];
$contact = $_POST['contactno'];


//INSERT


if($password != $conpassword)
{
    ?>
    
<?php
}
else
{
mysqli_query($con,"insert into patient (icPatient,password,patientFirstName,patientLastName,patientMaritialStatus,patientDOB,patientGender,patientAddress,patientPhone,patientEmail,patient) values ('$codenumber','$password','$patientFirstName','$patientLastName','$status','$patientDOB','$patientGender','$address','$contact','$patientEmail','New')") or die(mysql_error());
// echo $result;
header("Location:http://localhost/I.TSpec%20Appointment%20System/");
?> 
<?php
}
}
?>
   
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Fernandez Dental Clinic</title>
        <!-- Bootstrap -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/img/Tooth.ico" rel="icon">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
        <!-- navigation -->

        <style>
            .navbar
            {
                background:#ffffff;
                
            }
            .navbar-header
            {
                padding-bottom: -20px;
            }
            .copyright-bar
            {
                background:#00679A;
            }

        </style>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.php" style="color: darkblue;">Fernandez Dental Clinic<img alt=""></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->


                        <li><a href="#HOME"><img src="assets/img/Home_16.png"><strong>Home</a></strong></li>
                         <li><a href="#ABOUTUS"><img src="assets/img/About_16.png"><strong>About Us</strong></a></li>
                          <li><a href="#SERVICES"><img src="assets/img/Stethoscope_16.png"><strong>Services</strong></a></li>
                           <li><a href="#LOCATION"><img src="assets/img/Location_16.png"><strong>Location</strong></a></li>
                           <li><a href="#CONTACT"><img src="assets/img/Phone_16.png"><strong>Contact Us</strong></a></li>
                           <!--<li><a href="#FAQS"><img src="assets/img/FAQ_16.png"><strong>FAQ</strong></a></li>-->
                         
                        <li><a href="signupform.php?#HOME"><img src="assets/img/Signup_16.png"><strong>Sign up</a></strong></li>
                   
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><img src="assets/img/Enter_16.png">Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" style="text-align: center;"class="form-control" name="icPatient" placeholder="*Enter Email/Username*" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" style="text-align: center;" class="form-control" name="password" placeholder="*Enter Password*" required>
                                                    <?php if (isset($_POST['login'])){?>
                                                <span class="label label-important" style="color: red; margin-left: 10%;"><?php echo $logerror; ?></span><?php }?>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-success btn-block" onclick="loginerror()">Sign in</button>
                                                    
                                                </div>
                                                <!--<div class="form-group">
                                                    Forget account?<a data-toggle="modal" data-target="#modalrecover" style="cursor: pointer;"> Recover your Account</a>
                                                    
                                                </div>-->
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- navigation -->

      


        <!-- modal container start -->
       
        <!-- modal end -->
        <!-- modal container end -->

        <!-- 1st section start -->
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <div class="container" id="HOME">
                <div class="row">
                    <div class="col-md-5">
                        <h2>Make an appointment today!</h2>
                        <p>Please <span class="label label-danger">Login</span> or <a href="signupform.php">Make an account</a> first to make an Appointment.</p>
                            
                        <!-- date textbox -->
                       
                        <!--<div class="input-group" style="margin-bottom:10px;">
                            <div class="input-group-addon">
                                <img src="assets/img/Calendar_16.png">
                                
                            </div>
                            <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
                        </div>
                       
                        <!-- date textbox end -->

                        <!-- script start -->
                        <script>

                            function showUser(str) {
                                
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
                                    return;
                                } else { 
                                    if (window.XMLHttpRequest) {
                                        // code for IE7+, Firefox, Chrome, Opera, Safari
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        // code for IE6, IE5
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                        }
                                    };
                                    xmlhttp.open("GET","getuser.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        
                        <!-- script start end -->
                     
                        <!-- table appointment start -->
                        <div id="txtHint"><b> </b></div>
                        
                        <!-- table appointment end -->
                    </div>

                    <!-- /.col -->
                   <!--  <div class="col-md-6 col-md-offset-1">
                        <div class="video-wrapper">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/FEoQFbzLYhc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div> -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>

       

        <!--About Us Content -->
        <style>
            .da-thumbs {
    list-style: none;
    position: relative;
    margin: 20px auto;
    padding: 0;
    float:left;
}
.da-thumbs li {
    float: left;
    margin: 5px;
    background: #fff;
    padding: 8px;
    position: relative;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.da-thumbs li a,
.da-thumbs li a img {
    display: block;
    position: relative;
}
.da-thumbs li a {
    overflow: hidden;
}
.da-thumbs li a div {
    position: absolute;
    background: rgba(75,75,75,0.7);
    width: 100%;
    height: 100%;
}
.da-thumbs li a div.da-animate {
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s ease-in-out;
    -ms-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
/* Initial state classes: */
.da-slideFromTop {
    left: 0px;
    top: -100%;
}
.da-slideFromBottom {
    left: 0px;
    top: 100%;
}
.da-slideFromLeft {
    top: 0px; 
    left: -100%;
}
.da-slideFromRight {
    top: 0px;
    left: 100%;
}
/* Final state classes: */
.da-slideTop {
    top: 0px;
}
.da-slideLeft {
    left: 0px;
}
.da-thumbs li a div span {
    display: block;
    padding: 10px 0;
    margin: 40px 20px 20px 20px;
    text-transform: uppercase;
    font-weight: normal;
    color: rgba(255,255,255,0.9);
    text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
    border-bottom: 1px solid rgba(255,255,255,0.5);
    box-shadow: 0 1px 0 rgba(0,0,0,0.1), 0 -10px 0 rgba(255,255,255,0.3);
}
        </style>
        <section id="content-1-9" class="content-1-9 content-block">
            <div class="container" id="ABOUTUS">
                <div class="underlined-title">
                    <h1>About Us</h1>
                    <hr>
                    <h2>Who we are? Meet Our Team</h2>
                </div>
                <style type="text/css">
.carousel{
    background: #ffffff;
    margin-top: 20px;
}
.carousel .item{
    min-height: 180px; /* Prevent carousel from being distorted if for some reason image doesn't load */
}
.carousel .item img{
    width: 100%; /* Align slide image horizontally center */
}
.bs-example{
    margin: 20px;
}
</style>

                    <div class="span12">
                        <!--<h6 style="text-align: justify;">Fernandez Dental Clinic is located at 543 Rizal Blvd. Brgy. Kanluran Rodsan Bldg. Sta. Rosa City Laguna. The clinic started way back 2005 around the month of May. By the time it has started the clinic only has two doctors but now the clinic has three doctors, Dr. Rodrigo Fernandez, Dr. Susan Fernandez and Dr. Mikee Fernandez. The clinic is run by the Fernandez family. Dr. Rodrigo Fernandez, the husband, 45 years of age and specializes in prosthodontics, surgery and aesthetic. Dr. Susan Fernandez, 44 years of age is an TMJ specialist and also in Orthodontics. Dr. Mikee Fernandez, 25 years of age, specializes in preventive pediatric, periodontics and aesthetic. On Mondays to Thursdays and Saturday, the clinic opens at 8:30 in the morning till 12 noon for a lunch break and opens again at 2:30 in the afternoon and closes at 6:00 in the evening. While on Friday and Sunday, the clinic opens at 8:30 in the morning and closes 12 noon.</h6>-->
               
            <div style="margin-left: 7%;">  
            <div class="col-md-4">
            <img src="assets/img/rodrigo.png" title='Dr. Rodrigo Fernandez' data-toggle="modal" data-target="#rodrigo" style='height: 300px; cursor: pointer;'/> 
            </div>
            <div class="col-md-4">
            <img src="assets/img/mikee.jpg" title='Dr. Mikee Fernandez' data-toggle="modal" data-target="#mikee" style='height:300px;cursor: pointer;margin-left: 10%;'/>
            </div>
            <div class="col-md-4">
            <img src="assets/img/susan.png" title='Dr. Susan Fernandez' data-toggle="modal" data-target="#susan" style='height:300px; cursor: pointer;'/>        
            </div>
            </div>
            



            </div>
                        
                <!-- /.row -->
            </div>
            
            <!-- /.container -->
        </section>




<!--Service Content-->

<style>
    .service-bg
    {
        background-repeat: no-repeat;
        background-image: url(assets/img/services.jpg);
        background-size: cover;
    }
</style>
<div class="service-bg">
            <div class="container" id="SERVICES">
                <div class="underlined-title">
                    <br>
                    <h1>Services Offered</h1>
                    <hr>
                    <h2>We provide a better service</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2"> 
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/prosto.jpg">
                            <h4>Prosthodontics</h4>
                            <p>Concerned with the design, manufacture, and fitting of artificial replacements for teeth and other parts of the mouth..</p>
                            <button type="button" data-toggle="modal" data-target="#myModal1"class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/aesthetic.jpg">
                            <h4>Cosmetic/Aesthetic</h4>
                            <p>Cosmetic dentistry is generally used to refer to any dental work that improves the appearance of teeth, gums and/or bite.</p>
                            <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">      
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/surgery.jpg">
                            <h4>Dental Surgery</h4>
                            <p>Medical procedures that involve artificially modifying dentition; in other words, surgery of the teeth and jaw bones.</p>
                            <button type="button" data-toggle="modal" data-target="#myModal3" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/orthodontics.jpg">
                            <h4>Orthodontics</h4>
                            <p>The dental specialty that is concerned with the diagnosis and treatment of dental deformities as well as irregularity in the relationship of the lower to the upper jaw.</p>
                            <button type="button" data-toggle="modal" data-target="#myModal4" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/TMJ.jpg">
                            <h4>TMJ specialist</h4>
                            <p>Concerns with the Temporomandibular joint syndrome(TMJ) a pain in the jaw joint that can be caused by a variety of medical problems.</p>
                            <button type="button" data-toggle="modal" data-target="#myModal5" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/pediatric.jpg">
                           <h4>Preventive pediatric</h4>
                            <p>Refers to prevention of disease and promotion of physical, mental and social well-being of children with the aim of attaining a positive health.</p>
                            <button type="button"data-toggle="modal" data-target="#myModal6" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pad25">
                        <div class="col-xs-2">
                        </div>
                        <div class="col-xs-10">
                            <img src="assets/img/eriodontics.jpg">
                            <h4>Periodontics</h4>
                            <p>Work closely with dental hygienists, generalists and other dental specialists, play key roles in formulating treatments for maintaining a healthy mouth.</p>
                            <button type="button" data-toggle="modal" data-target="#myModal7" class="btn btn-sm btn-success">Read More</button>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <br>
        </div>
        <br>


        <!-- <div class="bs-example">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>   
        
        <div class="carousel-inner" style="background: cover;">
            <div class="item active">
                <img src="assets/img/banner.png" alt="First Slide">
            </div>
            <div class="item">
                <img src="assets/img/b1.jpg" alt="Second Slide">
            </div>
            <div class="item">
                <img src="assets/img/slide.jpg" alt="Third Slide">
            </div>
        </div>
        
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <img src="assets/img/left_32.png" style="margin-top: 120px;">
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <img src="assets/img/right_32.png" style="margin-top: 120px;">
        </a>
    </div>
</div>
 -->
            <!-- /.container -->
        <!--Contact Us Content-->
        <br>
            <div class="container" id="LOCATION">
                <div class="underlined-title">
                    <h1>Location</h1>
                    <hr>
                    <strong><h2>Feel free to drop us a line to contact us</h2></strong>
                </div>
                <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d389.5092020699736!2d121.11185392426317!3d14.31161454527606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d9b06fab3fe1%3A0xfe61f67e0649325f!2sRod-San+Building!5e0!3m2!1sen!2sph!4v1534040006835" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!4v1534040421585!6m8!1m7!1sBJOlsS05Eoy8sDGULh9MPw!2m2!1d14.31176731446258!2d121.1119117821278!3f276.99487116628666!4f1.4067362940633217!5f0.7820865974627469" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
<br>
</div>
<br>
<div class="contact-bg">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5" id="CONTACT">CONTACT US</h2>
    <p class="text-center w-responsive mx-auto mb-5"><strong>Do you have any questions? Please do not hesitate to email or contact us directly.We will come back to you within
        matter of hours to help you.</p></strong>
<br>
<style>
    .contact-bg
    {   
        background-image: url(assets/img/contact.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<div class="row">
    <div class="col-md-10">
        <!-- <form action="index.php" method="POST">
    <strong><input type="text" name="fname" class="form-control"placeholder="Enter Firstname" style="margin-left:35%;width:30%;color: black;" required=""></strong>
    <br>
    <strong><input type="text" name="lname" class="form-control" placeholder="Enter Lastname" style="margin-left:35%;width:30%;color: black; " required=""></strong>
    <br>
    <strong><input type="text" name="emailadd" class="form-control" placeholder="Enter Email Address" style="margin-left:35%;width:30%; color: black;" required=""></strong>
     <br>
     <strong><input type="password" name="emailpass" class="form-control" placeholder="Enter Email Password" style="margin-left:35%;width:30%; color: black;" required=""></strong>
     <br>
    <strong><input type="text" name="subject" class="form-control" placeholder="Subject" style="margin-left:35%;width:30%;color: black;" required=""></strong>
     <br>
    <strong><textarea type="textarea" name="message" class="form-control" placeholder="Enter Message" style="margin-left:35%;width:30%;color: black; " required=""></textarea></strong>
    <br>
    <input type="submit" name="send" class="btn btn-sm btn-success" style="margin-left:35%;width:30%;"> -->
    </div>

    <div class="col-xs-12 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fa fa-map-marker fa-2x"></i>
                    <strong><p>543 Rizal Boulevard Poblacion Barangay Kanluran Rodsan Building Santa Rosa Laguna</p></strong>
                </li>

                <li><i class="fa fa-phone mt-4 fa-2x"></i>
                    <strong><p>+63 905-508-1683 (Dr.Mikee Fernandez)</p></strong>
                    <strong><p>+63 905-508-1683 (Dr.Rodrigo Fernandez)</p></strong>
                    <strong><p>+63 905-508-1683 (Dr.Susan Fernandez)</p></strong>
                </li>

                <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                    <strong><p>fernandezdentalfdc@gmail.com</p>
                    </strong>
                </li>
            </ul>
        </div>



</section>
</form>

<!--FOR CONTACT US FORM//SEND TO EMAIL -->
<!--<?php

if(isset($_POST['send']))
{



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $emailadd = $_POST['emailadd'];
    $emailpass = $_POST['emailpass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $wname = $fname." ".$lname;
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $emailadd;                 // SMTP username
    $mail->Password = $emailpass;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($emailadd,'$wname');   // Add a recipient
    $mail->addAddress('fernandezdentalfdc@gmail.com');               // Name is optional
    $mail->addReplyTo($emailadd,'Information');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
?>-->
<!--Contact Us Content-->
        <!-- Footer Content -->
        <br>

        
        <!-- footer end -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

    })


</script>

<div class="modal fade" id="rodrigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Dr.Rodrigo Fernandez</h3>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                              <img src="assets/img/rodrigo.png">

                            </div>
                        </div>
                    </div>
                </div>

  <!-- Modal for Prosthodontics-->
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Prosthodontics</h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo Fernandez</h4>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Prosthodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";


                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Prosthodontics end -->

                                <!-- Modal for Cosmetic/Aesthetic-->
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Cosmetic/Aesthetic</h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo/Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Cosmetic/Aesthetic'LIMIT 13");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Cosmetic/Aesthetic end -->

                                <!-- Modal for Surgery-->
                            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Surgery</h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Dental Surgery'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Surgery end -->

                                <!-- Modal for Orthodontics-->
                            <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Orthodontics</h3><h4 style="text-align: center;">Offered By: Dr.Susan Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Orthodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Orthodontics end -->

                                <!-- Modal for TMJ specialist-->
                            <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">TMJ specialist</h3><h4 style="text-align: center;">Offered By: Dr.Susan Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='TMJ specialist'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal TMJ specialist end -->

                                <!-- Modal for Preventive pediatric-->
                            <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Preventive pediatric</h3><h4 style="text-align: center;">Offered By: Dr.Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Preventive pediatric'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                                <!-- Modal Preventive pediatric end -->

                                <!-- Modal for Periodontics-->
                            <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Periodontics</h3><h4 style="text-align: center;">Offered By: Dr.Mikee Fernandez</h4>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                <br>
                                <?php
                                echo "<table class='table table-hover'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Services</th>";
                                echo "</tr>";
                                echo "</thead>";
                                
                                $res = mysqli_query($con,"SELECT * from service where service_type ='Periodontics'");
                                while ($service = mysqli_fetch_array($res))
                                {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $service['service_name'] . "</td>";
                                echo "</tr>";
                            }
                                echo "</tbody>";
                                echo "</table>";

                                ?>
                              
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalrecover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Prosthodontics</h3><h4 style="text-align: center;">Offered By: Dr.Rodrigo Fernandez</h4>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">
                                

                            </div>
                        </div>
                    </div>
                </div>



                                <!-- Modal Periodontics end -->
<script>
    $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actual4:59 PM 8/19/20184:59 PM 8/19/2018ly gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          
        });
      }
    }
  });
</script>

<div class="copyright-bar">
    <div class="container">
        <p class="pull-left small">Copyright © 2018 | Dental Clinic Appointment System | B.P,M.L,R.R,R.M | All Rights reserved</p>
        <p class="pull-right small"><a href="adminlogin.php"><strong>Log in as Doctor?</strong></a></p>
    </div>
</div>

    <!-- date end -->
   
</body>
</html>