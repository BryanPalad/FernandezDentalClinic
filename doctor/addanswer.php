<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
$doctorsession = $_SESSION['doctorSession'];
$resres=mysqli_query($con,"SELECT * FROM doctor WHERE doctorid=".$doctorsession);
$doctorRow=mysqli_fetch_array($resres,MYSQLI_ASSOC);
?>

<?php
if (isset($_GET['appId'])) {
    $id = $_GET['appId'];
}
$res=mysqli_query($con,
"SELECT * from faq where id =".$id);

$faq_row = mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome Dr. <?php echo $doctorRow['doctorFirstName'];?> <?php echo $doctorRow['doctorLastName'];?></title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- Custom Fonts -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php" style="color: white;">Welcome Dr. <?php echo $doctorRow['doctorFirstName'];?> <?php echo $doctorRow['doctorLastName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png"> <?php echo $doctorRow['doctorFirstName']; ?> <?php echo $doctorRow['doctorLastName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><img src="assets/img/Profile_16.png"> Profile</a>
                            </li>
                            <li>
                                <a href="settings.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><img src="assets/img/logout_16.png"> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                         <li>
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="walkin.php"><i class="fa fa-fw fa-user"></i> Walk-in </a>
                        </li>
                        <li>
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Patient List</a>
                        </li>
                        <li>
                            <a href="services.php"><i class="fa fa-fw fa-th-list"></i> Services </a>
                        </li>
                        <li>
                            <a href="doctors.php"><i class="fa fa-fw fa-stethoscope"></i> Doctors </a>
                        </li>
                         <li>
                            <a href="reports.php"><i class="fa fa-fw fa-folder"></i> Reports </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Frequently Asked Question
                            </h2>
                            <h6>Status: <?php echo $faq_row['status'];?></h6>
                             <form action="settings.php" method="POST" onsubmit="return('Are you sure you want to submit this FAQ?');">
                                <input type="hidden" name="faqid" value="<?php echo $faq_row['id'];?>">
                            <h4>Question:</h4>
                            <textarea name="question" disabled="true"class="form-control input-lg" value="<?php echo $faq_row['question'];?>" rows="3"><?php echo $faq_row['question'];?>
                            </textarea>
                            <h4>Answer:</h4>
                            <textarea name="answer" value="<?php echo $faq_row['question'];?>" class="form-control input-lg" rows="3"><?php echo $faq_row['answer'];?>
                            </textarea>

                            <br>
                            <input type="submit" name="submitfaq" class="btn btn-primary" value="Submit FAQ">
                        </div>
                    </div>
                </form>
        <!-- /#wrapper -->
        
       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/date/bootstrap-datepicker.js"></script>
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        
        <script>
        $(document).ready(function(){
        var date_input=$('input[name="startDate"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        })
        })
        </script>
        <script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
    </body>
</html>