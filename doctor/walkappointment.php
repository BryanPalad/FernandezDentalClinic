<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



?>
<?php 
$walkin = $_GET['walk'];

$sql = mysqli_query($con,"SELECT * from patientinfo where icPatient ='$walkin'");
$fetched = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Walk-in</title>
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
                    <a class="navbar-brand" href="doctordashboard.php" style="color: white;">Welcome Dr. <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png"> <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?><b class="caret"></b></a>
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
                        <li  class="active">
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
                            Walk-in
                            </h2>
                        </div>
                    </div>
                           <form method="POST">
                            <div class="col-md-2">
                            Last Name: <input type="text" class="form-control input-md" name="name" value="<?php echo $fetched['patientLastName'];?>" disabled>
                            </div>
                              <div class="col-md-2">
                            First Name: <input type="text" class="form-control input-md" name="name" value="<?php echo $fetched['patientFirstName'];?>" disabled>
                            </div>
                        <div class="col-md-4">
                            Doctor: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['doctorFirstName']." ".$userRow['doctorLastName'];?>"disabled >
                        </div>
                        <div class="col-md-2">
                            Remarks: <textarea rows="1" style="width: 300px;" value="Walk-in" disabled>Walk-in</textarea>
                             <br> <br> <br> <br>
                        </div>
                   
            <div class="col-md-4">
                <label for="recipient-name" class="control-label">Service:</label>
                <select name="services" class="form-control input-lg" required="">
                                                    <option></option>
                                                    <?php
                                        $doc = mysqli_real_escape_string($con,$userRow['doctorFirstName']);

                                        $re = mysqli_query($con,"SELECT * from service where doctorFirstName ='$doc'");
                                        while ($rere = mysqli_fetch_array($re)) {

                                        ?>
                                                    <option value="<?php echo $rere['service_name']; ?>">
                                                        <?php echo $rere['service_name']; ?>
                                                    </option>
                                                    <?php }
                                            ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="recipient-name" class="control-label">Add Service:</label>

                                                <select name="addservice" class="form-control input-lg">
                                                    <option></option>
                                                    <?php
                                        $doc = mysqli_real_escape_string($con,$userRow['doctorFirstName']);

                                        $re = mysqli_query($con,"SELECT * from service where doctorFirstName ='$doc'");
                                        while ($rere = mysqli_fetch_array($re)) {

                                        ?>
                                                    <option value="<?php echo $rere['service_name']; ?>">
                                                        <?php echo $rere['service_name']; ?>
                                                    </option>
                                                    <?php }
                                            ?>
                                                </select>

 
                </div>
                <div class="col-md-4">
                <label>Select Date:</label>
                                    <div class="input-group" style="margin-bottom:10px;">
                                        <div class="input-group-addon">
                                            <img src="../patient/assets/img/Calendar_16.png">
                                        </div>
                                        <input class="form-control" id="startDate" onchange="getTime()" name="startDate" value="<?php echo date("Y-m-d")?>" required=""/>
                                    </div>

                                    <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o">
                                            </i>
                                        </div>
                                        <select id="selectOption" name="startTime" class="form-control input-lg" required="">
                                        <option></option> 
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                <button type="submit" name='walkinapp' class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        
        <?php
        if(isset($_POST['walkinapp']))
        {
            // for patient info //
            $icPatient = $fetched['icPatient'];
            $username = $fetched['username'];
            // for appointment info //
            $service = $_POST['services'];
            $addservice = $_POST['addservice'];

            $services = $service." ".$addservice;   
            $startDate = $_POST['startDate']; 
            $startTime = $_POST['startTime'];


            $sqlquery = mysqli_query($con,"INSERT into schedule (icPatient,username,doctorid,scheduleDate,servicename,status,startTime,complain,reminded,appointmentid,remarks) values ('$icPatient','$username','$usersession','$startDate','$services',default,'$startTime','Walk-in','0',default,'null')");
            ?>
            <script type="text/javascript">
                alert('Successfully added schedule');
                window.location.href = 'walkin.php';
            </script>
            <?php
        }
 
        ?>

                                <script>
                                    function getTime(){
                                        var startDate = $('#startDate').val();
                                        var docID = <?php echo $userRow['doctorid'];?>;
                                        $.ajax({
                                        type: "GET",
                                        url: "getTime.php",
                                        data: {"startDate": startDate, "docID": docID},
                                        success: function(result) {
                                            //console.log(result);
                                            $( "#selectOption" ).html(result);
                                        }
                                    });
                                    }
                                </script>
       
        <!-- jQuery -->
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
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
        <!-- script for jquery datatable end-->

    </body>
</html>