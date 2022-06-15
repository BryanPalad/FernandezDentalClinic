<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: doctor/doctordashboard.php");
}
if (isset($_POST['login']))
{
$doctorEmail = mysqli_real_escape_string($con,$_POST['doctorEmail']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorEmail = '$doctorEmail' or doctorFirstName = '$doctorEmail'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// echo $row['password'];
if ($row['password'] == $password)
{
$_SESSION['doctorSession'] = $row['doctorid'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: doctor/doctordashboard.php");
} else {
$a = "Invalid Email / First Name / Password";
}
}
?>
<?php 
        $header = mysqli_query($con,"SELECT * from header");
        $headers = mysqli_fetch_array($header);
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fernandez Dental Clinic</title>
        <!-- Bootstrap -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>

        <?php
        $background = mysqli_query($con,"SELECT * from background where id ='1'");
        $backgrounds = mysqli_fetch_array($background);

        $background2 = mysqli_query($con,"SELECT * from background where id ='2'");
        $backgrounds2 = mysqli_fetch_array($background2);

        $background3 = mysqli_query($con,"SELECT * from background where id ='3'");
        $backgrounds3 = mysqli_fetch_array($background3);

        ?>
        <?php
        $welcome = mysqli_query($con,"SELECT * from welcome");
        $welcomes = mysqli_fetch_array($welcome);
        ?>
        <style>
.mySlides {display:none;}
</style>
        
        <div class="w3-content w3-section">
  <?php echo "<img class='mySlides' src='doctor/uploads/".$backgrounds['background']."' style='width:1400px;height:670px;margin-left:-200px;margin-top:-70px;'>"?>
 <?php echo "<img class='mySlides' src='doctor/uploads/".$backgrounds2['background']."' style='width:1400px;height:670px;margin-left:-200px;margin-top:-70px;'>"?>
  <?php echo "<img class='mySlides' src='doctor/uploads/".$backgrounds3['background']."' style='width:1400px;height:670px;margin-left:-200px;margin-top:-70px;'>"?>
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}       
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 3000); // Change image every 3 seconds
}
</script>
        <!-- <?php echo "<img src='doctor/uploads/".$headers['background']."' style='height:690px;width:100%;margin-top:-60px;background-size: cover;
                -moz-background-size: cover; 
                background-position: center;'>";?> -->
        
        
        <div class="container" style="margin-top:-630px;">
            <!-- start -->
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <input name="doctorEmail" type="text" placeholder="Doctor Email / First Name" required>
                            <input name="password" type="password" placeholder="Password" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>

                            <a class="btn btn-danger btn-block" href="http://localhost/I.TSpec%20Appointment%20System/index.php">Back</a>
                            <br>
                            <?php if (isset($_POST['login'])){?>
                        <span class="label label-danger"><?php echo $a; ?></span><?php }?>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>

        <script src="assets/js/jquery.js"></script>

        <!-- js start -->
        
        <!-- js end -->
    </body>
</html>