<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session=$_SESSION[ 'patientSession'];

$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patientinfo a
	JOIN schedule b
		On a.icPatient = b.icPatient
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	WHERE b.username ='$session' order by b.scheduleDate desc");

	if (!$res) {
		die( "Error running $sql: " . mysqli_error());
	}
	$userRow=mysqli_fetch_array($res);
?>	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Appointment List</title>
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/img/Tooth.ico" rel="icon">
		<link href="assets/css/material.css" rel="stylesheet">
		
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

	</head>
	<body>
		<!-- navigation -->
		<?php 
		$header = mysqli_query($con,"SELECT * from header");
		$headers = mysqli_fetch_array($header);

		?>
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<?php
         $header = mysqli_query($con,"SELECT * from header");
         $headers = mysqli_fetch_array($header);
         ?>
         <a class="navbar-brand" href="patient.php" style="color:<?php echo$headers['header_color'];?>;"><?php echo $headers['header_title'];?><img alt=""></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php"><img src="assets/img/Home_16.png">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Planner_16.png"> Appointment</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png"> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Profile_16.png"> Profile</a>
								</li>
								 <li>
                                    <a href="dentalrecords.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Medical_16.png"> Dental Records</a>
                                </li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><img src="assets/img/logout_16.png"> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
<!-- display appoinment start -->
<?php


echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h1>Your appointment list. </h1>";
echo "</div>";
echo "<h6 style='color:red;'> <strong>Note: Patient/s must be at the clinic 30 minutes before the appointment !!!</h6></strong> ";
echo "<div class='panel panel-primary'>";
echo "<div class='panel-heading'>List of Appointments</div>";
echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Doctor</th>";
echo "<th>scheduleDate </th>";
echo "<th>Service/s </th>";
echo "<th>Remark/s</th>";
echo "<th>Start Time</th>";
echo "<th>Status</th>";
echo "<th>Cancel</th>";
echo "<th>Print</th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT a.*,b.* from schedule a join doctor b on a.doctorid = b.doctorid where username ='$session' and a.status !='cancelled' order by a.scheduleDate desc");

while ($join = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $join['doctorFirstName'] . " ".$join['doctorLastName']."</td>";
echo "<td>" . $join['scheduleDate'] . "</td>";
echo "<td>"	. $join['servicename'] . "</td>";
echo "<td>"	. $join['complain'] . "</td>";
echo "<td>" . date("h:i A", strtotime($join['startTime'])) . "</td>";
echo "<td>"	. $join['status'] . "</td>";
 echo "<td class='text-center'><a href='#' id='".$join['appointmentid']."' class='delete'><img src='assets/img/Cancel_16.png' style='margin-left:-50%;'aria-hidden='true'></a>
                            </td>";	
echo "<td><a href='invoice.php?appid=".$join['appointmentid']."' target='_blank'><img src='assets/img/Print_16.png' style='margin-left:10%;'aria-hidden='true'>	</a> </td>";

}

echo "</tr>";

echo "</tbody>";
echo "</table>";

?>
	</div>
</div>
</div>
</div>


<!-- display appoinment end -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appid = element.attr("id");
var info = 'id=' + appid;
if(confirm("Are you sure you want to cancel this appointment?"))
{
 $.ajax({
   type: "POST",
   url: "cancel.php",
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
</body>
</html>