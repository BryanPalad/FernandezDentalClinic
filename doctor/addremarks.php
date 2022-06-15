<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: patientlist.php");
}

$doctorsession = $_SESSION['doctorSession'];
$resres=mysqli_query($con,"SELECT * FROM doctor WHERE doctorid=".$doctorsession);
$doctorRow=mysqli_fetch_array($resres,MYSQLI_ASSOC);
?>

<?php
if (isset($_GET['appId'])) {

$patientRow = $_GET['appId'];
   }
$res=mysqli_query($con,"SELECT a.*, b.*,c.*
                                                    FROM patientinfo a
                                                    JOIN appointments b
                                                    On a.username = b.patientusername
                                                    JOIN doctorschedule c
                                                    On b.scheduleId=c.scheduleId where b.appId = '$patientRow'
                                                    Order By scheduleDate desc");

$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

?>

<?php

if(isset($_POST['submit']))
{
    $remarks = $_POST['remarks'];

    $sql = mysqli_query($con,"UPDATE appointments set remarks ='$remarks' where appId ='$patientRow'");
}
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
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
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
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Patient List</a>
                        </li>
                        <li>
                            <a href="services.php"><i class="fa fa-fw fa-edit"></i> Services</a>
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
                            Remarks
                            </h2>
                            <h4>Information</h4>
                            <form action="addremarks.php" method="POST">
                            <div class="col-md-2">
                            Name: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['patientFirstName']." ".$userRow['patientLastName'];?>" disabled>
                            </div>
                            <div class="col-md-2">
                            Date: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['scheduleDate'];?>" disabled>
                            </div>
                             <div class="col-md-2">
                            Service Time: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['service_time'];?>"disabled>
                                </div>
                         <div class="col-md-6">
                             Service/s: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['appSymptom'];?>"disabled>
                        </div>
                         <div class="col-md-2">
                            Complain: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['appComment'];?>"disabled>
                        </div>
                         <div class="col-md-2">
                            Status: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['status'];?>"disabled>
                        </div>
                         <div class="col-md-2">
                            Schedule Date: <input type='date' name="date" ">

                        </div>
                        <div class="col-md-2">
                            Add Remarks: <textarea name="remarks" style="width: 350%;"></textarea>
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                         </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    
                        </div>

                    </div>
                </form>
                        </div>

                    </div>
                    <!-- USER PROFILE ROW END-->
                            
                            
                    </div>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>  
                    </div>
                    <!-- panel start -->

                </div>
            </div>


        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
    </body>
</html>