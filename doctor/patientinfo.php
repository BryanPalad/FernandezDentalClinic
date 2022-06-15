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
if (isset($_GET['icPatient'])) {
$patientRow = $_GET['icPatient'];
}
$res=mysqli_query($con,"SELECT * FROM patientinfo WHERE icPatient=".$patientRow);

$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

$pat = $userRow['icPatient'];
?>

<?php
$doc = mysqli_query($con,"SELECT * from schedule where icPatient='$pat'");

$docRow = mysqli_fetch_array($doc,MYSQLI_ASSOC);

$docc = $docRow['icPatient'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Patient Profile</title>
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
                            Patient Profile
                            </h2>
                            
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Patient Details</h3>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                          <div class="container">
            <section style="padding-bottom: 50px; padding-top: 50px;">
                <div class="row">
                    <!-- start -->
                    <!-- USER PROFILE ROW STARTS-->
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            
                            <div class="user-wrapper">
                               <?php echo "<img src='../patient/uploads/".$userRow['image']."' style='height:280px; width:100%;'>";
                                ?>
                                <div class="description">
                                    <h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
                                    <h5> <strong><?php echo $userRow['patient'];?> Patient </strong></h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-sm-7">
                            <div class="description">

                                <hr/>
                                
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        
                                        <table class="table table-user-information"  align="center">
                                            <tbody>
                                                
                                                
                                                <tr>
                                                    <td>Patient ID</td>
                                                    <td><?php echo $userRow['icPatient']; ?></td>
                                                </tr>
                                                
                                                    <td>Address</td>
                                                    <td><?php echo $userRow['patientAddress']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Contact #</td>
                                                    <td><?php echo $userRow['patientPhone']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $userRow['patientEmail']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Birthdate</td>
                                                    <td><?php echo $userRow['patientDOB']; ?>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>Status</td>
                                                    <td><?php echo $userRow['patientMaritialStatus']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td><?php echo $userRow['patientGender']; ?>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>Occupation</td>
                                                    <td><?php echo $userRow['patientOccupation']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>




                                        </table>

                                    </div>

                                </div>



                            </div>
                             <div class="panel panel-primary filterable">
                        <!-- Default panel contents -->
                       <div class="panel-heading">
                        <h3 class="panel-title">Appointment Records</h3>
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
                                     <th><input type="text" class="form-control" placeholder="Doctor" disabled></th>
                                     <th><input type="text" class="form-control" placeholder="Date" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Start Time" disabled></th>              
                                    <th><input type="text" class="form-control" placeholder="Service/s" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Remarks" disabled></th>
                                    
                                </tr>
                            </thead>
                            
                            <?php 
                             $docc = $docRow['icPatient'];
                            $gg=mysqli_query($con," SELECT a.*, b.*,c.*
                                                    FROM patientinfo a
                                                    JOIN schedule b
                                                    On a.icPatient = b.icPatient
                                                    JOIN doctor c on b.doctorid = c.doctorId
                                                    where b.status = 'done' and a.icPatient = '$pat'
                                                    Order By b.scheduleDate desc");
                                  if (!$gg) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            while ($appointment=mysqli_fetch_array($gg)) {
                                if ($appointment['status']=='pending') {
                                    $status="warning";
                                    $icon='remove';
                                    $checked='';

                                }
                                else if($appointment['status']=='cancelled')
                                {
                                    $status="danger";
                                } else {
                                    $status="success";
                                    $icon='ok';
                                    $checked = 'disabled';
                                }
                                echo "<tbody>";
                                echo "<tr class='$status'>";
                                echo "<td> <img src='uploads/".$appointment['image']."' style='height:60px;'></td>";
                                echo "<td>" . $appointment['doctorFirstName'] ." ".$appointment['doctorLastName']. "</td>";
                                    echo "<td>" . $appointment['scheduleDate'] . "</td>";
                                    echo "<td>" . date("h:i A", strtotime($appointment['startTime'])) ."</td>";
                                    echo "<td>" . $appointment['servicename'] . "</td>";
                                    echo "<td>" . $appointment['complain'] . "</td>";
                                     echo "<td class='text-center'>
                                    <a style='margin: 2px' href='editrecords.php?appId=".$appointment['appointmentid']."' id='".$appointment['appointmentid']."' name='info' class='info' title='More Information'><img src='assets/img/Info_16.png' aria-hidden='true'></a></td>";

                               
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