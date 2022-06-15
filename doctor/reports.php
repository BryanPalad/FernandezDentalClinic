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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Reports</title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/img/tooth.ico" rel="icon">
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
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
                        <li  class="active">
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
                            Dashboard
                            </h2>
                            
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Successful Appointments</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Search</button>
                        </div>
                        </div>
                        <div class="panel-body">
                        <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th>Image</th>
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Contact" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Start Time" disabled></th>              
                                    <th><input type="text" class="form-control" placeholder="Service/s" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Remarks" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $docn = $userRow['doctorFirstName'];
                            $res=mysqli_query($con,"SELECT a.*, b.*
                                                    FROM patientinfo a
                                                    JOIN schedule b
                                                    On a.icPatient = b.icPatient
                                                    where b.status = 'done' and b.doctorid =$usersession
                                                    Order By b.scheduleDate desc ");
                                  if (!$res) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            while ($appointment=mysqli_fetch_array($res)) {
                                if ($appointment['status']=='process') {
                                    $status="danger";
                                    $icon='remove';
                                    $checked='';

                                } else {
                                    $status="success";
                                    $icon='ok';
                                    $checked = 'disabled';
                                }
                                echo "<tbody>";
                                echo "<tr class='$status'>";
                                    echo "<td> <img src='../patient/uploads/".$appointment['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $appointment['patientFirstName'] ." ". $appointment['patientLastName'] . "</td>";
                                    echo "<td>" . $appointment['patientPhone'] . "</td>";
                                    echo "<td>" . $appointment['scheduleDate'] . "</td>";
                                    echo "<td>" . date("h:i A", strtotime($appointment['startTime'])) ."</td>";
                                    echo "<td>" . $appointment['servicename'] . "</td>";
                                    echo "<td>" . $appointment['complain'] . "</td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                    </div>
                </div>



                <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Cancelled Appointments</h3>
                        <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Search</button>
                        </div>
                        </div>
                        <div class="panel-body">
                        <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                   <th>Image</th>
                                    <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Contact" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Service Time" disabled></th>              
                                    <th><input type="text" class="form-control" placeholder="Service/s" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Remarks" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $docn = $userRow['doctorFirstName'];

                            $res=mysqli_query($con,"SELECT a.*, b.*
                                                    FROM patientinfo a
                                                    JOIN schedule b
                                                    On a.icPatient = b.icPatient
                                                    where b.status = 'cancelled'
                                                    Order By b.scheduleDate desc  ");
                                  if (!$res) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            while ($appointment=mysqli_fetch_array($res)) {
                                if ($appointment['status']=='cancelled') {
                                    $status="danger";
                                    $icon='remove';
                                    $checked='';

                                } else {
                                    $status="success";
                                    $icon='ok';
                                    $checked = 'disabled';
                                }
                                echo "<tbody>";
                                echo "<tr class='$status'>";
                                    echo "<td> <img src='../patient/uploads/".$appointment['image']."' style='height:60px;'></td>";
                                    echo "<td>" . $appointment['patientFirstName'] ." ". $appointment['patientLastName'] . "</td>";
                                    echo "<td>" . $appointment['patientPhone'] . "</td>";
                                    echo "<td>" . $appointment['scheduleDate'] . "</td>";
                                    echo "<td>" . date("h:i A", strtotime($appointment['startTime'])) ."</td>";
                                    echo "<td>" . $appointment['servicename'] . "</td>";
                                    echo "<td>" . $appointment['complain'] . "</td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                    </div>
                </div>
                    <!-- panel end -->
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
</script>


 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appid = element.attr("id");
var info = 'id=' + appid;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "deleteappointment.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
        </script>
        <!-- script for jquery datatable end-->

    </body>
</html>