<?php
include ('assets/conn/dbconnect.php');

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
$email = $_GET['email'];
$code = $_GET['code'];

if(isset($_POST['signup']))     
{
$emails = $_POST['email'];
$codes = $_POST['code'];
$verify = $_POST['coded'];

$result = mysqli_query($con,"SELECT * FROM verify WHERE email ='$emails' AND code = '$codes'");

                if(mysqli_num_rows($result)==0)
                {
                    ?>
                    <script type="text/javascript">
                        alert('Invalid Input Code, Please Try Again..');
                    </script>
                    <?php
                }
                else
                {
                    $step1 = mysqli_query($con,"DELETE FROM verify WHERE email ='$emails' AND code = '$codes'");
                    $step2 = mysqli_query($con,"UPDATE patientinfo SET verified = 1 WHERE patientEmail = '$emails'");
                   ?>
                    <script type="text/javascript">
                        alert('Your Account has been verified!!!, You can now login to your account.');
                        window.location.href='index.php';
                    </script>
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
<br>
<br>
    <div class="body-bg">
        <div class="underlined-title">
            <h1>Verify your Email</h1>
            <br>
            <div class="container">
                <br>
                <form action="verifyform.php?email=<?=$email;?>&code=<?=$code;?>" method="POST">

                    <input type="hidden" name="email" value="<?php echo $email;?>">
                     <input type="hidden" name="code" value="<?php echo $code;?>">
            <input type="text" name="coded" class="form-control input-lg" style="width: 50%; text-align: center; margin-left: 25%;" placeholder="ENTER VERIFICATION CODE SENT TO YOUR EMAIL.." required="">
            <button name="signup" type="submit" class="btn btn-success btn-block"><img src="assets/img/in_16.png">&nbsp;Submit</button>
        </div>
        </div>
    </form>
        <form method="post">
        <div class="container"> 
    <!-- date end -->
   
</body>
</html>