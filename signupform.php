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
// $Code = $_POST['code'];

$age = "";
$ab = "";
$emailerror = "";
$codeerror = "";
$pword = "";

}
    
?>
<?php 
$emailCode = substr(md5(mt_rand()), 0, 15);
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
            <h1><img src="assets/img/sign_48.png"> Sign Up Here</h1>
            <hr>
            <h2>Its Free and always will be</h2>
        </div>
        <form method="post">
        <div class="container"> 
    
            
    <div class="form-horizontal">
        <div class="control-group">

            <!--<div class="col-md-4">

                <img src="assets/img/teeth.gif">
                <img src="assets/img/teeth.gif">

            </div>-->
            <div class="col-md-6">
                <div class="controls">
                    <input type="hidden" name="codede" value="<?php echo $emailCode;?>">
            <input type="text" class="form-control input-lg"   onkeypress="return alpha(event)" name="patientFirstName" value="<?php if (isset($_POST['signup'])){echo $patientFirstName;} ?>" placeholder="*Enter Firstname" required><br>
                </div>
            </div>

                <div class="col-md-6">
            <input type="text" name="patientLastName" class="form-control input-lg" onkeypress="return alpha(event)" value="<?php if (isset($_POST['signup'])){echo $patientLastName;} ?>" placeholder="*Enter Lastname" required>  
                </div>
        </div>
        <div class="col-md-12">     
        <div class="control-group">
            <div class="controls">
            <input name="patientEmail" type="email" class="form-control input-lg" id="patientEmail" value="<?php if (isset($_POST['signup'])){echo $patientEmail;} ?>" placeholder="*Email Address" required>

            <span id = "Result" align = "center"></span>
            
            <?php if (isset($_POST['signup'])){?>
                        <span class="label label-important" style="color: red; margin-left: 80%;"><?php echo $emailerror; ?></span><?php }?>
            </div>
        </div>
        </div>
        

        <div class="col-md-12">
            <br>
         <label><strong>Select Birth Date:</strong></label>
         
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Month</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Day</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Year</option>
                                                    
                                                    <option value="1950">1950</option>
                                                    <option value="1951">1951</option>
                                                    <option value="1952">1952</option>
                                                    <option value="1953">1953</option>
                                                    <option value="1954">1954</option>
                                                    <option value="1955">1955</option>
                                                    <option value="1956">1956</option>
                                                    <option value="1957">1957</option>
                                                    <option value="1958">1958</option>
                                                    <option value="1959">1959</option>
                                                    <option value="1960">1960</option>
                                                    <option value="1961">1961</option>
                                                    <option value="1962">1962</option>
                                                    <option value="1963">1963</option>
                                                    <option value="1964">1964</option>
                                                    <option value="1965">1965</option>
                                                    <option value="1966">1966</option>
                                                    <option value="1967">1967</option>
                                                    <option value="1968">1968</option>
                                                    <option value="1969">1969</option>
                                                    <option value="1970">1970</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                </select>
                                            </div>
                                        </div>
                                    


    </div>


    <div class="col-md-12">
         
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <input type="text" onkeypress="return alpha(event)" name="occupation" class="form-control input-lg" placeholder="Occupation">

                                            </div>

                                            <div class="col-xs-4 col-md-4">
                                                <div class="gender" style="margin-top: 2%;">
                                                <select name="patientGender" class="form-control input-lg">
                                                    <option>Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>

                                                </select>
                                         </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="status" class = "form-control input-lg" required>
                                                    <option value="">Civil Status</option>
                                                    
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Divorced">Divorced</option>
                                                         <option value="Widowed">Widowed</option>
                                                                                       </select>
                                            </div>
                                        </div>
                                    


    </div>
</div>

    
    
    <div class="span6">
    
    <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="text" name="patientAddress" class="form-control input-lg" value="<?php if (isset($_POST['signup'])){echo $address;} ?>" placeholder="*Current Address" required>

            </div>
        </div>
    </div>

        
        <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "11" name="contactno" class="form-control input-lg"value="<?php if (isset($_POST['signup'])){echo $contact;} ?>"placeholder="*Contact No" required>

            </div>
        </div>
        </div>
    </div>

    <!--<div class="col-md-8">
        <div class="control-group">
            <div class="controls">

        
            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            type = "number"
            maxlength = "4" name="codeNumber" id="username" class="form-control input-lg" value="<?php if (isset($_POST['signup'])){echo $codenumber;} ?>" placeholder="*Enter 4 Digit Access Code" required>

            </div>
        </div>
        </div>-->

     <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="text" name="username" id="username" class="form-control input-lg"value="<?php if (isset($_POST['signup'])){echo $username;} ?>" placeholder="*Enter Username">
            <span id = "Result1" align = "center"></span>
            </div>
        </div>
    </div>


<script type="text/javascript">
                 $(document).ready(function() {
            $('#patientEmail').keyup(function(){
              $.post("checkemail.php", {
                patientEmail: $('#patientEmail').val()
              }, function(response){
                $('#Result').fadeOut();
                setTimeout("finishAjax('Result', '"+escape(response)+"')", 400);
              });
                return false;
            });
        });
        function finishAjax(ip, response) {
          $('#Result').hide();
          $('#'+ip).html(unescape(response));
          $('#'+ip).fadeIn();
        } 
            </script>

<script type="text/javascript">
        $(document).ready(function() {
            $('#username').keyup(function(){
              $.post("check.php", {
                username: $('#username').val()
              }, function(response){
                $('#Result1').fadeOut();
                setTimeout("finishAjax('Result1', '"+escape(response)+"')", 400);
              });
                return false;
            });
        });
        function finishAjax(id, response) {
          $('#Result1').hide();
          $('#'+id).html(unescape(response));
          $('#'+id).fadeIn();
        } 
</script>


        


        <div class="col-md-12">
        <div class="control-group">
            <div class="controls">
            <input type="password" name="pass" id="password-field" class="form-control input-lg"value="<?php if (isset($_POST['signup'])){echo $password;} ?>" placeholder="*Enter Password">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
        </div>
        </div>

        <div class="col-md-12">
            <div class="controls">
            <input type="password" name="conpass" id="confirm" class="form-control input-lg" onkeyup="checkPasswordMatch();" placeholder="*Confirm Password" required>

            <div class="registrationFormAlert" id="divCheckPasswordMatch">
            </div>

        </div>
        </div>

        <br>
        
        <div class="col-md-12">
    <div class="control-group">
                <label class="control-label" for="inputEmail"></label>
                <div class="controls">
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    $('#refresh').tooltip('show');
                    $('#refresh').tooltip('hide');
                })
            </script>
                <!-- <img  src="generatecaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg' alt='captcha image'> 
                <a href="javascript: refreshCaptcha();"><i data-placement="right" id="refresh"  title="Click to Refresh Code"><img src="reload.gif"></i></a> 
                <script language='JavaScript' type='text/javascript'>
                    
            function refreshCaptcha()
            {
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
            }
            </script> -->
                
                </div>
                
    </div>
    </div>

        <div class="col-md-12">
            <div class="control-group">
    <div class="controls">
    <!-- <input id="code" name="code" type="text" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "6"class="form-control input-lg"placeholder="*Enter the Code Above"> -->
    <br>

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
    $patientGender =$_POST['patientGender'];
    $status = $_POST['status'];
    $address = $_POST['patientAddress'];
    $contact = $_POST['contactno'];
    // $Code = $_POST['code'];
    $emailCode = substr(md5(mt_rand()), 0, 15);

    /*$sql = "SELECT * from patient where icPatient = '$codenumber'";
    $result = mysqli_query($con,$sql);
    $res = mysqli_fetch_array($result);*/
    
    /*if($res['patientEmail'] > 0)
    {
        ?>
        <script>
        window.alert('Email already exists');
        </script>
        <?php
    }
    else if($res['icPatient'] >= 1)
    {
        ?>
        <script>
        window.alert('Access number already exists, Please try another one');
        </script>
        <?php
    }*/
    // if(strcmp($_SESSION['code'], $_POST['code']) != 0) //==0 change to !=0 to make it work again
    // {
    // ?>
    // <script>
    //     window.alert("CODE DOES NOT MATCH");
    // </script>
    <?php
    if($password == $conpassword)
    // else if(strcmp($_SESSION['code'], $_POST['code']) == 0 && $password == $conpassword) //!= 0 change to ==0 to make it work again
    {
        mysqli_query($con,"insert into patientinfo (icPatient,username,password,patientFirstName,patientLastName,patientMaritialStatus,patientDOB,patientGender,patientAddress,patientPhone,patientEmail,patient,status,image,patientOccupation) values (default,'$username','$password','$patientFirstName','$patientLastName','$status','$patientDOB','$patientGender','$address','$contact','$patientEmail','New','Active','not-available.png','$occupation')") or die(mysql_error());
        mysqli_query($con, "insert into verify (email, code) values ('$patientEmail', '$emailCode')") or die(mysql_error());
          
    ?>
    <script>
        var email = "<?php echo $patientEmail;?>";
        var code = "<?php echo $emailCode;?>";

        console.log (email + " " +code);
        $.ajax({
            type: "GET",
            url: "send-verification.php",
            data: {"email": email, "code": code},
            success: function(result) {
                console.log(result);
            }
        });
        
        window.alert("Created account, Please copy the code sent to your Email to verify.");
        window.location.href = "verifyform.php?email=<?=$patientEmail;?>&code=<?=$emailCode;?>";
    </script>
    <?php
}
}
else{
echo " ";
}
?>


</div>
</div>
</div>

                    <?php

                    $gg = mysqli_query($con,"SELECT * from terms");
                    $sql = mysqli_fetch_array($gg);
                    ?>

                <div class="col-md-8">
                    <input type="checkbox" required="" style="text">I have read and agree with the <a style="cursor: pointer;" data-toggle="modal" data-target="#modalterms">terms and conditions.</a> of the clinic.
                    
                </div>

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

            <div class="col-md-12">
            <div class="control-group">
            
<div class="control-group">
            <div class="controls">
                
                <button name="signup" type="submit" class="btn btn-success btn-block"><img src="assets/img/in_16.png">&nbsp;Create my Account</button>
            </div>
        </div>

    </div>
</form>

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
<script type="text/javascript">

    function checkPasswordMatch() {
    var password = $("#password-field").val();
    var confirmPassword = $("#confirm").val();


    if(password.length < 8)
        $("#divCheckPasswordMatch").html("<div class ='iddd'>*Password must be above 8 characters*</div>");
    else if(password == "" || confirmPassword == "")
        $("#divCheckPasswordMatch").html("");

    else if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<div class ='id'>*Password does not Match*</div>");
    else
        $("#divCheckPasswordMatch").html("<div class='idd'>*Password Match*</div>");
}
    $(document).ready(function () {
   $("#password-field, #confirm").keyup(checkPasswordMatch);
});


</script>
<script>
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
        
</script>
        
</div>
</div>
         <br>
         <br>


    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    
   
    <!-- date start -->
  
  <script type="text/javascript">

function alpha(e) {
     var k;
     console.log(e);
     document.all ? k = e.keyCode : k = e.which;
     return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || k == 0);
}

</script>

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


</div>
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
<div class="copyright-bar" >
    <div class="container-fluid">
        <p class="pull-left small" style='margin-left:100px;color:<?php echo$footers['footer_color'];?>'><?php echo $footers['title']?></p>
        <p class="pull-right small" style="margin-right:90px;"><a data-toggle='modal' data-target='#terms' style="cursor: pointer;"><strong> Terms and Conditions </strong></a><a href="testimonials.php"><strong> Testimonials </strong></a><a data-toggle='modal' data-target='#privacy' style="cursor: pointer;"><strong> Privacy Policy </strong></a><a href="adminlogin.php"><strong> Log in as Doctor? </strong></a></p>
    </div>
</div>
    <!-- date end -->
   </form>
</body>
</html>