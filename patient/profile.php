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

<?php
if (isset($_POST['submit'])) {
//variables
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientMaritialStatus = $_POST['patientMaritialStatus'];
$patientDOB = $_POST['patientDOB'];
$patientGender = $_POST['patientGender'];
$patientAddress = $_POST['patientAddress'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
$pass = $_POST['patientpassword'];
$occupation = $_POST['occupation'];

// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patientinfo SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientMaritialStatus='$patientMaritialStatus', patientDOB='$patientDOB', patientGender='$patientGender', patientAddress='$patientAddress', patientPhone='$patientPhone', patientEmail='$patientEmail', password='$pass', patientOccupation='$occupation' WHERE username='$usersession'");
// $userRow=mysqli_fetch_array($res);
?>
<script>
	window.alert("Successfully updated");
	window.location.href = 'profile.php';
</script>
<?php

}
?>
<?php
$male="";
$female="";
if ($userRow['patientGender']=='male') {
$male = "checked";
}elseif ($userRow['patientGender']=='female') {
$female = "checked";
}
$single="";
$married="";
$separated="";
$divorced="";
$widowed="";
if ($userRow['patientMaritialStatus']=='single') {
$single = "checked";
}elseif ($userRow['patientMaritialStatus']=='married') {
$married = "checked";
}elseif ($userRow['patientMaritialStatus']=='separated') {
$separated = "checked";
}elseif ($userRow['patientMaritialStatus']=='divorced') {
$divorced = "checked";
}elseif ($userRow['patientMaritialStatus']=='widowed') {
$widowed = "checked";
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Patient Profile</title>
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
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<?php echo "<img src='uploads/".$userRow['image']."'>";

								?>
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									<h5> <strong> Patient </strong></h5>
									<p>
										Welcome to your Profile, You can update your informations here by clicking the update button...
									</p>
									<br>
									<form action="profile.php" method="POST" enctype="multipart/form-data">
									<label>Change Profile Picture</label>
									<input type="file" name="image">
									<input type="submit" name="upload" value="Upload" class="btn btn-success" style="width: 35%;">
								</div>
							</div>
						</div>
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

	<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3 style="text-align: center;"> Patient Information</h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
												<tr>
													<td>Patient ID</td>
													<td><?php echo $userRow['icPatient']; ?></td>
												</tr>
												<tr>
													<td>Civil Status</td>
													<td><?php echo $userRow['patientMaritialStatus']; ?></td>
												</tr>
												<tr>
													<td>Date of Birth</td>
													<td><?php echo $userRow['patientDOB']; ?></td>
												</tr>
												<tr>
													<td>Gender</td>
													<td><?php echo $userRow['patientGender']; ?></td>
												</tr>
												<tr>
													<td>Address</td>
													<td><?php echo $userRow['patientAddress']; ?>
													</td>
												</tr>
												<tr>
													<td>Contact No.</td>
													<td><?php echo $userRow['patientPhone']; ?>
													</td>
												</tr>
												<tr>
													<td>Email Address</td>
													<td><?php echo $userRow['patientEmail']; ?>
													</td>
												</tr>
												<tr>
													<td>Occupation:</td>
													<td><?php echo $userRow['patientOccupation']; ?>
													</td>
												</tr>
											</tbody>
										</table>

									</div>

								</div>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Patient Information</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>Patient ID:</td>
														<td><?php echo $userRow['icPatient']; ?></td>
													</tr>
													<tr>
														<td>Password:</td>
														<td><input type="password" class="form-control" onkeyup=""name="patientpassword" value="<?php echo $userRow['password']; ?>"  /></td>
													</tr>
													<tr>
														<td>First Name:</td>
														<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
													</tr>
													<tr>
														<td>Last Name:</td>
														<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
													</tr>
													<!-- radio button -->
													<tr>
														<td>Civil Status:</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" checked=""value="Single" <?php echo $single; ?>>Single</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="married" <?php echo $married; ?>>Married</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="separated" <?php echo $separated; ?>>Separated</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="divorced" <?php echo $divorced; ?>>Divorced</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="widowed" <?php echo $widowed; ?>>Widowed</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													<tr>
														<td>Date of Birth:</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="patientDOB" name="patientDOB" placeholder="MM/DD/YYYY" type="text" value="<?php echo $userRow['patientDOB']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td>Gender:</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" checked="" value="Male" <?php echo $male; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="Female" <?php echo $female; ?>>Female</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td>Phone number:</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email:</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>Address:</td>
														<td><textarea class="form-control" name="patientAddress"  ><?php echo $userRow['patientAddress']; ?></textarea></td>
													</tr>
													<tr>
														<td>Occupation:</td>
														<td><input type="text" class="form-control" name="occupation" value="<?php echo $userRow['patientOccupation']; ?>"  /></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>

			
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			
			<script type="text/javascript">
														$(function () {
														$('#patientDOB').datetimepicker();
														});
														</script>
		</body>
	</html>