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
        <title>Patient List</title>
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
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Patient List</a>
                        </li>
                         <li class="active">
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
                            Services
                            </h2>
                            
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary filterable">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Services Offered</h3>
                            <div class="pull-right">
                            <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                           <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Service Type" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Service Name"  disabled></th>
                                    <!-- <th><input type="text" class="form-control" placeholder="Email" disabled></th> -->


                                    
                                </tr>
                            </thead>
                            
                            <?php 
                            $doc = mysqli_real_escape_string($con,$userRow['doctorFirstName']);

                            $result=mysqli_query($con,"SELECT * from service where doctorFirstName ='$doc'");
                            

                                  
                            while ($services=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";

                                    echo "<td>" . $services['service_type'] . "</td>";
                                    echo "<td>" . $services['service_name'] . "</td>";
                                    
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><a href='editservice.php?appId=".$services['service_id']."'><img src='assets/img/edit_16.png' aria-hidden='true' title='Update service'></span></a></td>";
                                    echo "<td class='text-center'><a href='#modalservice' id='".$services['service_id']."' class='delete'><img src='assets/img/trash_16.png' aria-hidden='true' title='Remove service'></span></a>
                            </td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                      
                        echo "</div>";
                        echo "</div>";
                        ?>
                        <!-- panel content end -->
                        <!-- panel end -->
                        Add New Service?<a style="cursor: pointer;"data-toggle="modal" data-target="#modalservice"><img src="assets/img/Addservice_32.png"></a>
                        </div>
                    </div>
                    <!-- panel start -->

                </div>
            </div>
            <div class="modal fade" id="modalservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <h3 class="modal-title" style="text-align: center; color: skyblue;">Add New Service</h3>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">

                                 <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                <label><strong>Service Type</strong></label>
                               <input type="text" name="service_type" class="form-control input-lg" required="">
                                    
                
                                <br>
                                  <label><strong>Service Name</strong></label>
                                  <input type="text" name="service_name" class="form-control input-lg" required="">
                                  <br>
                                  <label><strong>Select Time Limit</strong></label>
                                  <select name="time" class="form-control input-lg" required="">
                                      <option></option>
                                      <option></option>
                                                    <option value="15">15 minutes</option>
                                                    <option value="20">20 minutes</option>
                                                    <option value="30">30 minutes</option>
                                                    <option value="40">40 minutes</option>
                                                    <option value="50">50 minutes</option>
                                                    <option value="60">1 hour</option>
                                                    <option value="75">1 hour and 15 min</option>
                                                    <option value="90">1 hour and 30 min</option>
                                                    <option value="120">2 hours</option>
                                  </select>
                                  <br>
                                  <div class="form-group">
                                                <input type="submit" name="add" id="add" class="btn btn-primary" value="Add Service">
                                            </div>
                                  <div class="modal-footer">
                                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top: -10%;padding-bottom: -10%;">Close
                                   </button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>


        <!-- /#wrapper -->

        <div class="modal fade" id="modalservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                           <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- modal content -->
                            <div class="modal-header">
                                <h3 class="modal-title" style="text-align: center; color: skyblue;">Add New Service</h3>
                            </div>
                            <!-- modal body start -->
                            
                            <div class="modal-body">

                                 <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                <label><strong>Service Type</strong></label>
                               <input type="text" name="service_type" class="form-control input-lg" required="">
                                    
                
                                <br>
                                  <label><strong>Service Name</strong></label>
                                  <input type="text" name="service_name" class="form-control input-lg" required="">
                                  <br>
                                  <label><strong>Select Time Limit</strong></label>
                                  <select name="time" class="form-control input-lg" required="">
                                      <option></option>
                                      <option></option>
                                                    <option value="15">15 minutes</option>
                                                    <option value="20">20 minutes</option>
                                                    <option value="30">30 minutes</option>
                                                    <option value="40">40 minutes</option>
                                                    <option value="50">50 minutes</option>
                                                    <option value="60">1 hour</option>
                                                    <option value="75">1 hour and 15 min</option>
                                                    <option value="90">1 hour and 30 min</option>
                                                    <option value="120">2 hours</option>
                                  </select>
                                  <br>
                                  <div class="form-group">
                                                <input type="submit" name="add" id="add" class="btn btn-primary" value="Add Service">
                                            </div>
                                  <div class="modal-footer">
                                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-top: -10%;padding-bottom: -10%;">Close
                                   </button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

<!--<?php
if(isset($_POST['update']))
$servicetime = $POST['servicetime'];


$sqls = "UPDATE from service set service_time ="
?>-->

<?php
if (isset($_POST['add'])) 
{
    $serve = $_POST['servicetime'];
    $service_name = $_POST['service_name'];
    $service_type = $_POST['service_type'];
    $time = $_POST['time'];   
    $doctorfname = $userRow['doctorFirstName'];
    $doctorlname = $userRow['doctorLastName'];
    $doctorId = $userRow['doctorId'];

  $query = "INSERT INTO service ( service_id, service_type , service_name , doctorFirstName ,doctorLastName,service_time,doctorId)
        VALUES (default,'$service_type', '$service_name', '$doctorfname','$doctorlname
        ','$time','$doctorId')";

        $result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Schedule added service.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('Added fail. Please try again.');
</script>
<?php
}

}
?>



?>

       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var ic = element.attr("id");
var info = 'ic=' + ic;

if(confirm("Are you sure you want to remove this service?"))
{
 $.ajax({
   type: "POST",
   url: "deleteservice.php",
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
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
    </body>
</html>