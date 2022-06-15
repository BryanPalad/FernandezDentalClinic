<?php
include ('assets/conn/dbconnect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

$res = mysqli_query($con,"SELECT * FROM patientinfo WHERE username = '$icPatient' or patientEmail ='$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

$logerror = "";
if ($row['password'] == $password and $row['verified'] == '1')
{
$_SESSION['patientSession'] = $row['username'];

header("Location: patient/patient.php");

} else {
   
 $logerror = "*Invalid Username / Password*";

}
}
?>
<?php
if (isset($_POST['signup'])) {
$patientFirstName = $_POST['patientFirstName'];
$patientLastName  = $_POST['patientLastName'];
$patientEmail     = $_POST['patientEmail'];
$username = $_POST['username'];
$occupation = $_POST['occupation'];
$password         = $_POST['pass'];
$conpassword = $_POST['conpass'];
$month            = $_POST['month'];
$day              = $_POST['day'];
$year             = $_POST['year'];
$patientDOB       = $year . "-" . $month . "-" . $day;
$patientGender = $_POST['patientGender'];
$status = $_POST['status'];
$address = $_POST['patientAddress'];
$contact = $_POST['contactno'];
$Code = $_POST['code'];

$age = "";
$ab = "";
$emailerror = "";
$codeerror = "";
$pword = "";

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
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href="assets/css/material.css" rel="stylesheet">
        <script src="assets/js/jquery.js"></script>
        
        
    </head>
    <body>
        <!-- navigation -->
        <?php
        $header = mysqli_query($con,"SELECT * from header");
        $headers = mysqli_fetch_array($header);
        ?>
        <style>
            .navbar
            {
                background:<?php echo $headers['color'];?>;
                
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

                    
                    <a class="navbar-brand" href="index.php" style="color:<?php echo$headers['header_color'];?>;"><?php echo $headers['header_title'];?><img alt=""></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->

                        <li><a href="index.php"><img src="assets/img/Home_16.png"><strong>Home</a></strong></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><img src="assets/img/Enter_16.png">Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">Email</label>
                                                    <input type="text" style="text-align: center;"class="form-control" name="icPatient" return false;" placeholder="*Enter Email/Username*" required>

                                                    <span id="access_status"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Password</label>
                                                    <input type="password" style="text-align: center;" class="form-control" name="password" placeholder="*Enter Password*" required>
                                                    <?php if (isset($_POST['login'])){?>
                                                <span class="label label-important" style="color: red; margin-left: 10%;"><?php echo $logerror; ?></span><?php }?>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-success btn-block">Sign in</button>
                                                    
                                                </div>
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
        
        <br>

                    <?php

                    $gg = mysqli_query($con,"SELECT * from terms");
                    $sql = mysqli_fetch_array($gg);
                    ?>

                 <div class="modal fade" id="modalterms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center; color: skyblue;">Terms and Conditions </h3>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body" style="font-family: Century Gothic; font-size: 20px;">
                                <?php echo$sql['terms'];?>
                                <br>
                                <h4>Late for Appointment:</h4>
                                <?php echo$sql['late'];?>
                                <br>
                                <h4>Guarantee:</h4>
                                <?php echo$sql['guarantee'];?>
                                <br>
                                <h4>Personal Details:</h4>
                                <?php echo$sql['personal_details'];?>
                                <br>
                                <h4>No Tolerance/Abuse Policy:</h4>
                                <?php echo$sql['abuse_policy'];?>
                                <br>
                                <h4>Data Protection:</h4>
                                <?php echo$sql['data_protection'];?>          
                            </div>
                        </div>
                    </div>
                </div>

            


    <style type="text/css">
        .id 
        {
            color:red;
        }
        .idd
        {
            color: green;
        }
        .iddd
        {
            color: orange;
        }
        .field-icon {
          float: right;
          margin-left: -25px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
        }

        .container{
          margin: auto;
          padding-left: 10%;
          padding-right: 10%;
        }
    </style>


</div>
         <br>
         <br>
         <style type="text/css">
    /*.container {
    border: 2px solid #ccc;
    background-color: hsla(0, 10%, 70%, 0.10);
    border-radius: 40px;
    padding: 16px;
    margin: 16px 0;
}*/

/* Clear floats after containers */
.containers::after {
    content: "";
    clear: both;
    display: table;
}

/* Float images inside the container to the left. Add a right margin, and style the image as a circle */
.containers img {
    float: left;
    margin-right: 20px;
    border-radius: 50%;
}

/* Increase the font-size of a span element */
.containers span {
    font-size: 20px;
    margin-right: 15px;
}

/* Add media queries for responsiveness. This will center both the text and the image inside the container */
@media (max-width: 500px) {
  .containers {
    text-align: center;
  }

  .containers img {
    margin: auto;
    float: none;
    display: block;
  }
}
</style>
<?php 
$testimonial = mysqli_query($con,"SELECT * from testimonials where status='approved'");
?>
<br>
<h2 style="color: #black; text-align: center;margin-top:-35px;">Testimonials</h2>
<br>

<div class="containers">
    <div class="col-md-6">
    <?php while($testimonial_row=mysqli_fetch_array($testimonial)):
        if ($testimonial_row['image']==null) {
                $avatar=$testimonial_row['image'];
            
            }
            else{
                $avatar=$testimonial_row['image'];
            }
        ?>
  <?php echo "<img src='patient/uploads/".$testimonial_row['image']."' style='width:90px;'>";?>
  <p style="font-size:15px;"><span><?=$testimonial_row['fullname']?></span>says</p>
  <p style="font-family:Consolas;font-size:20px;"><?=nl2br($testimonial_row['descriptions']);?></p>
  <br><br><br>
  <?php endwhile;?>


</div>
<div class="col-md-6">
        
        <h5>Add Testimonials:</h5>
        <form action="testimonials.php" method="POST">
        <input type="email" name="email" placeholder="*Enter Patient Email" class="form-control input-lg" required="" >
        <input type="password" name="pass" placeholder="*Enter Password" class="form-control input-lg" required="">
        <br>
        <textarea name="texttestimonials" rows="4" placeholder="*Enter your Testimonials here..." class="form-control input-lg" required=""></textarea>
        <button type="submit" name="submittestimonials" class="btn btn-success">Submit Testimonials</button>
        </form>
</div>
</div>
        <?php 
        if(isset($_POST['submittestimonials']))
        {
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $pass  = mysqli_real_escape_string($con,$_POST['pass']);
            $descriptions = $_POST['texttestimonials'];

           $sql = mysqli_query($con,"SELECT * FROM patientinfo WHERE patientEmail ='$email' or password ='$pass'");

            $fetch = mysqli_fetch_array($sql);
            $image = $fetch['image'];
            $firstname= $fetch['patientFirstName'];
            $lastname= $fetch['patientLastName'];
            $fullname = $firstname." ".$lastname;

            if ($fetch['password'] == $pass)
            {
           
             mysqli_query($con,"INSERT into testimonials (id,fullname,image,descriptions,status) values (default,'$fullname','$image','$descriptions',default)");

                   ?>
                <script>
                    alert('Your testimonial has been submitted and is pending approval by an administrator.');
                    window.location.href = "testimonials.php";
                </script>
                 <?php

            } 
            else
            {
               ?>
                <script>
                    alert('Invalid Patient Email / Password');
                    window.location.href = "testimonials.php";
                </script>
                <?php
            }
            }

        ?>


    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    
   
    <!-- date start -->


</div>
</div>



                                <!-- Modal Periodontics end -->
<?php
$terms = mysqli_query($con,"SELECT * from terms");
$termss = mysqli_fetch_array($terms); 
?>
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Terms and Conditions</h3>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body" style="font-family: Times New Roman; font-size: 20px;">

                                <?php echo$termss['terms'];?>
                                <br>
                                <h4>Late for Appointment:</h4>
                                <?php echo$termss['late'];?>
                                <br>
                                <h4>Guarantee:</h4>
                                <?php echo$termss['guarantee'];?>
                                <br>
                                <h4>Personal Details:</h4>
                                <?php echo$termss['personal_details'];?>
                                <br>
                                <h4>No Tolerance/Abuse Policy:</h4>
                                <?php echo$termss['abuse_policy'];?>
                                <br>
                                <h4>Data Protection:</h4>
                                <?php echo$termss['data_protection'];?>
                            </div>
                        </div>
                    </div>
                </div>
<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" style="text-align: center;">Privacy Policy</h3>
                                
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body" style="font-family: Times New Roman; font-size: 20px;">

                                <?php echo$termss['privacy'];?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $footer = mysqli_query($con,"SELECT * from footer");
                $footers = mysqli_fetch_array($footer);
                ?>
                <style type="text/css">
                    .copyright-bar
                    {
                        background:<?php echo $footers['color'];?>;
                    }
                </style>
                <br>
<div class="copyright-bar" >
    <div class="container-fluid">
        <p class="pull-left small" style='margin-left:100px;color:<?php echo$footers['footer_color'];?>'><?php echo $footers['title']?></p>
        <p class="pull-right small" style="margin-right:90px;"><a data-toggle='modal' data-target='#terms' style="cursor: pointer;"><strong> Terms and Conditions </strong></a><a href="testimonials.php"><strong> Testimonials </strong></a><a data-toggle='modal' data-target='#privacy' style="cursor: pointer;"><strong> Privacy Policy </strong></a><a href="adminlogin.php"><strong> Log in as Doctor? </strong></a></p>
    </div>
</div>
    <!-- date end -->
   
</body>
</html>