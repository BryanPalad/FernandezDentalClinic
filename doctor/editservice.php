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
    $patientRow = $_GET['appId'];
}

$res=mysqli_query($con,
"SELECT a.*, b.*
FROM patientinfo a
JOIN schedule b
On a.icPatient = b.icPatient
where b.appointmentid=$patientRow
Order By b.scheduleDate desc");

$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

?>

<?php

// if(isset($_POST['submit']))
// {
//     $remarks = $_POST['remarks'];
//     $sql = mysqli_query($con,"UPDATE appointments set remarks ='$remarks' where appId ='$patientRow'");
// }

if(isset($_POST['complete']))
{

     $icPatient = $userRow['icPatient'];
    $username = $userRow['username'];
    $doctorid = $userRow['doctorid'];
    $scheduleDate = $_POST['startDate'];
    $service_id = $userRow['service_id'];
    $servicename = $userRow['servicename'];
    $startTime = $_POST['startTime'];
    $medication = $_POST['medication'];
    $diagnosis = $_POST['diagnosis'];
    $prognosis = $_POST['prognosis'];

    $sql = mysqli_query($con,"UPDATE schedule set status = 'done',medication='$medication',diagnosis='$diagnosis',prognosis='$prognosis' where appointmentid ='$patientRow'");


    mysqli_query($con,"UPDATE patientinfo set patient='Old' where icPatient =$icPatient");

    header("Location: doctordashboard.php");

}

if(isset($_POST['modify']))
{
      $icPatient = $userRow['icPatient'];
    $username = $userRow['username'];
    $doctorid = $userRow['doctorid'];
    $scheduleDate = $_POST['startDate'];
    $service_id = $userRow['service_id'];
    $servicename = $userRow['servicename'];
    $startTime = $_POST['startTime'];
    $medication = $_POST['medication'];
    $diagnosis = $_POST['diagnosis'];
    $prognosis = $_POST['prognosis'];
    $schedid = $userRow['scheduleid'];


     $sql1 = mysqli_query($con,"UPDATE schedule set status = 'done',medication='$medication',diagnosis='$diagnosis',prognosis='$prognosis' where appointmentid ='$patientRow'");
    
  
   $sql2 = mysqli_query($con,"INSERT INTO schedule (icPatient ,username,scheduleid,doctorid, scheduleDate ,service_id,servicename,status, startTime, complain)
    VALUES ( '$icPatient','$username','$schedid','$doctorid', '$scheduleDate', '$service_id ','$servicename ', default, '$startTime','Follow-Up')");
    header("Location: doctordashboard.php");
}
        ?>
        <?php
        function itexmo($number,$message,$apicode){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
        $param = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
        ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);}
        //##########################################################################
        if(isset($_POST['modify']))
        {
        /*for patient*/

        $startTime = $_POST['startTime'];
        $start = date("h:i A",strtotime($startTime));
        $scheduleDate = $_POST['startDate'];
        $pname = $userRow['patientFirstName'];
        $dfname = $doctorRow['doctorFirstName'];
        $dlname = $doctorRow['doctorLastName'];
        $dfull = $dfname." ".$dlname;
        $number = $userRow['patientPhone'];
        $name = "Fernandez Dental Clinic";
        $msg = "Hi"." ".$pname."! "." You have been scheduled by Doctor"." ".$dfull." on"." ".$scheduleDate." at ".$start.", Please go to the clinic 30 minutes before your appointment Thankyou!.";
        $text = "From: ".$name." 
        ".$msg;
        //$api = "TR-VALVE578299_XV4NS";
        $api = "ST-BRYAN151340_9LFL5";

        /*for doctor*/

        $result = itexmo($number,$text,$api);
        if ($result == ""){
        echo "iTexMo: No response from server!!!
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
        Please CONTACT US for help. ";  
        }else if ($result == 0){
        echo "Message Sent!";
        }
        else{   
        echo "Error Num ". $result . " was encountered!";
        }
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
        <title>Modify Appointment</title>
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
                            Modify Appointment
                            </h2>
                            <h4>Information</h4>
                           
                            <div class="col-md-3">
                            <img src="../patient/uploads/<?php echo $userRow['image'];?>" style='height: 250px;'>
                            </div>
                            <div class="col-md-2">
                            Name: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['patientFirstName']." ".$userRow['patientLastName'];?>" disabled>
                            </div>
                            <div class="col-md-2">
                            Date: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['scheduleDate'];?>" disabled>
                            </div>
                             <div class="col-md-2">
                            Start Time: <input type="text" class="form-control input-md" name="name" value="<?php echo date("h:i A", strtotime($userRow['startTime']));?>"disabled>
                                </div>
                         <div class="col-md-6">
                             Service/s: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['servicename'];?>"disabled>
                        </div>
                         <div class="col-md-2">
                            Status: <input type="text" class="form-control input-md" name="name" value="<?php echo $userRow['status'];?>"disabled>
                        </div>
                        <div class="col-md-4">
                            Doctor: <input type="text" class="form-control input-md" name="name" value="<?php echo $doctorRow['doctorFirstName']." ".$doctorRow['doctorLastName'];?>"disabled >
                        </div>
                        <div class="col-md-2">
                            Remarks: <textarea name="remarks" rows="1" style="width: 300px;" value="<?php echo $userRow['complain'];?>" disabled><?php echo $userRow['complain'];?></textarea>
                        </div>


                         </div>
                    </div>
                    <!-- Page Heading end-->
                    <div>
                        <hr>
                        <form method="POST">
                            <div>
                                <div class="row">
                                <div class="col-md-3">

                                    <label> Medication:</label>
                                    <div class="input-group">
                                        <textarea name="medication" style="width:250px; height:80px;" required=""><?php echo $userRow['medication'];?></textarea>                 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label> Diagnosis:</label>
                                    <div class="input-group">
                                        <textarea name="diagnosis" style="width:250px; height:80px;" required=""><?php echo $userRow['diagnosis'];?></textarea>                 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label> Prognosis:</label>
                                    <div class="input-group">
                                        <textarea name="prognosis" style="width:250px; height:80px;" required=""><?php echo $userRow['prognosis'];?></textarea>                 
                                    </div>
                                </div>
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
                                <div class="col-md-3">
                                    <div class="col-md-10">
                                        <h7>Follow up schedule:</h7>
                                    <label>Select Date:</label>
                                    <div class="input-group" style="margin-bottom:10px;">
                                        <div class="input-group-addon">
                                            <img src="../patient/assets/img/Calendar_16.png">
                                        </div>
                                        <input class="form-control" id="startDate" onchange="getTime()" name="startDate" value="<?php echo date("Y-m-d")?>" required=""/>
                                    </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o">
                                            </i>
                                        </div>
                                        <select id="selectOption" name="startTime" class="form-control input-lg">
                                        <option></option> 
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-md-12">
                                        <input type="submit" onclick="return confirm('Are you sure you want to complete this appointment');" name="complete"
                                        id="submit" class="btn btn-primary" value="Complete Appointment">
                                        <input type="submit" onclick="return confirm('Are you sure you want to make a follow up schedule');" name="modify"
                                        id="submit" class="btn btn-primary" value="Follow Up">
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <!-- panel start -->
                    
                        </div>

                    </div>
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