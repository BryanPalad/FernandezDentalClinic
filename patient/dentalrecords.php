<?php
session_start();
// include_once '../connection/server.php';
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];
$res=mysqli_query($con,"SELECT * FROM patientinfo WHERE username='$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Dental Records</title>
		<!-- Bootstrap -->
		<link href="assets/img/Tooth.ico" rel="icon">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
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
		
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
							</form>
		<?php

		if(isset($_POST['upload']))
		{

			$gg = $userRow['icPatient'];

			$targetdata = "uploads/";
			$target = $targetdata.basename($_FILES['image']['name']);

			$image = $_FILES['image']['name'];

			$sql = "UPDATE patientinfo set image ='$image' where icPatient =$gg";

			$result = mysqli_query($con,$sql);

			if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
			{
				$msg = "Image uploaded successfully";
				header('Location:profile.php');
			}
			else
			{
				$msg = "There was a problem uploading image";
			}
		}

		?>

	<div class="col-md-12 col-sm-12  user-wrapper" style="width: 110%;margin-left: -55px;">
		
							<div class="description">
								<h3 style="text-align: left;">Dental Records</h3>
								<hr />
								
								
<?php

echo "<div class='panel panel-primary' style='width:auto;'>";
echo "<div class='panel-heading'>My Appointments</div>";

echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Doctor</th>";
echo "<th>scheduleDate </th>";
echo "<th>Service/s </th>";
echo "<th>Start Time</th>";
echo "<th>Medication</th>";
echo "<th>Diagnosis</th>";
echo "<th>Prognosis</th>";
echo "<th>Remarks</th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT a.*,b.*,c.* from schedule a INNER join doctor b on a.doctorid = b.doctorId INNER join patientinfo c on a.icPatient = c.icPatient where c.username ='$usersession' and a.status = 'done' order by scheduleDate desc");

while ($join = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $join['doctorFirstName'] . " ".$join['doctorLastName']."</td>";
echo "<td>" . $join['scheduleDate'] . "</td>";
echo "<td>"	. $join['servicename'] . "</td>";
echo "<td>" . date("h:i A", strtotime($join['startTime'])) . "</td>";
echo "<td>"	. $join['medication'] . "</td>";
echo "<td>"	. $join['diagnosis'] . "</td>";
echo "<td>"	. $join['prognosis'] . "</td>";
echo "<td>"	. $join['complain'] . "</td>";
}

echo "</tr>";

echo "</tbody>";
echo "</table>";

?>
							</div>
							
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>

			
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			
		</body>
	</html>