	<?php
	session_start();
	include_once '../assets/conn/dbconnect.php';
	$session= $_SESSION['patientSession'];
	// $appid=null;
	// $appdate=null;
	if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
		$appdate =$_GET['scheduleDate'];
		$appid = $_GET['appid'];
		$serviceget = $_GET['servicename'];
	}
	// on b.icPatient = a.icPatient
	$res = mysqli_query($con,"SELECT a.*, b.*,c.* FROM doctorschedule a INNER JOIN patientinfo b JOIN doctor c WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND a.doctorFirstName = c.doctorFirstName and b.username='$session'");
	$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


	//INSERT
	?>


	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Appointment</title>
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link rel="icon" href="assets/img/tooth.ico">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">
		<script src="../assets/js/moment.min.js"></script>
		<script src="assets/js/jquery.js"></script>
		<link href="assets/css/material.css" rel="stylesheet">
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

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
				<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Planner_16.png">
						Appointment</a></li>
			</ul>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/Profile_16.png">
					<?php echo $userRow['patientFirstName']; ?>
					<?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><img src="assets/img/Profile_16.png">
							Profile</a>
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
					<img src="assets/img/tt.gif" class="img-responsive" />
					<div class="description">
						<h4>Welcome!
							<?php echo $userRow['patientFirstName']; ?>
							<?php echo $userRow['patientLastName']; ?>
						</h4>
						<h5> <strong> Patient </strong></h5>
						<p>
							Feel free to select your time and service.
						</p>
					</div>
				</div>
			</div>

			<div class="col-md-9 col-sm-9  user-wrapper">
				<div class="description">


					<div class="panel panel-default">
						<div class="panel-body">
							<form class="form" role="form" method="POST" accept-charset="UTF-8">
								<div class="panel panel-default">
									<div class="panel-heading" style="color: black;">Patient Information</div>
									<div class="panel-body">

										Patient Name:
										<?php echo $userRow['patientFirstName'] ?>
										<?php echo $userRow['patientLastName'] ?><br>
										<!--Patient IC: <?php echo $userRow['icPatient'] ?><br>-->
										Contact Number:
										<?php echo $userRow['patientPhone'] ?><br>
										Address:
										<?php echo $userRow['patientAddress'] ?>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" style="color: black;">Appointment Information</div>
									<div class="panel-body">
										Date:
										<?php echo $userRow['scheduleDate'] ?><br>
										Doctor:
										<?php echo $userRow['doctorFirstName'] ." ".$userRow['doctorLastName']?><br>
										Start Time:
										<?php echo date("h:i A",strtotime($userRow['startTime'])) ?><br>
										End Time:
										<?php echo date("h:i A", strtotime($userRow['endTime'])) ?><br>
									</div>
								</div>
								<style>
									.panel-heading
										{
											background-color: skyblue;
										}
									</style>
								<div class="panel panel-heading">
									<h4 style="text-align: center;">*Select service and time below*</h4>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<form action="appointment.php" method="POST">
												<span class="asteriskField" style="color: red;">
				                                    *
				                                   </span>
												<label for="recipient-name" class="control-label">Service:</label>

												<select name="servicegets" class="form-control input-lg" required="">
													<option selected="<?php echo $serviceget;?>"><?php echo $serviceget;?></option>
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
									</div>
									<script type="text/javascript">
		$('select').change(function() {
    var myOpt = [];
    $("select").each(function () {
        myOpt.push($(this).val());
    });
    $("select").each(function () {
        $(this).find("option").prop('hidden', false);
        var sel = $(this);
        $.each(myOpt, function(key, value) {
            if((value != "") && (value != sel.val())) {
                sel.find("option").filter('[value="' + value +'"]').prop('hidden', true);
            }
        });
    });
});
		</script>

									<div class="col-md-6">
									<?php 
									// $docStartTime = $userRow['startTime'];
									// echo date("h:i A",strtotime($docStartTime));
									?>
									<span class="asteriskField" style="color: red;">
				                                    *
				                                   </span>
										<label>Start Time:</label>
										<select name="starttime" class="form-control input-lg" required>
											<option></option>
											<?php
												$docId = $userRow['doctorId'];

												$docStartTime = $userRow['startTime'];
												$docEndTime = $userRow['endTime'];
												$docTimeToRender = round(abs(strtotime($docStartTime) - strtotime($docEndTime)) / 3600,2); // Get hours that will be rendered by the doctor

												$scheduleDate = date("Y-m-d", strtotime($userRow['scheduleDate']));
												$statement = "select * from schedule where doctorId = $docId and scheduleDate = '$scheduleDate' and status !='cancelled'";
												$prepare = mysqli_query($con, $statement);
												$availableTime =  date("h:i A", strtotime($docStartTime)); //display time in HH:MM A manner
												$notAvailableTime = [];
												while($row = mysqli_fetch_array($prepare))
												{
													$notAvailableTime[] = $row['startTime'];
												}
												for($i = 1; $i <=$docTimeToRender; $i++){
													
												if(!in_array(date("H:i:s", strtotime($availableTime)),$notAvailableTime)){
										
											?>	
												<option value="<?php echo date("H:i:s", strtotime($availableTime));?>">
												<?php echo $availableTime;//display time?></option>
											<?php 	
												}
												$availableTime = date("h:i A",strtotime($availableTime) + 3600); //+1 hr for every iteration
											}?>
										</select>
									</div>
									<div class="form-group col-md-12">
										<span class="asteriskField" style="color: red;">
				                                    *
				                                   </span>
										<label for="message-text" class="control-label">Remark/s:</label>
										<textarea class="form-control" name="comment" required=""></textarea>
									</div>
								</div>
						</div>
						<div class="form-group">
							<input type="submit" onclick="return confirm('Are you sure you want to make an appointment?');" name="appointment"
								id="submit" class="btn btn-primary" value="Make Appointment">
						</div>
						</form>
					</div>
				</div>

			</div>

		</div>
		</div>
		</form>
		<?php

		if (isset($_POST['appointment'])) {
		$patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
		$scheduleid = mysqli_real_escape_string($con,$appid);
		$servicegets = $_POST['servicegets'];
		$addservice = $_POST['addservice'];
		$symptom = $servicegets . "  ".$addservice;
		$comment = mysqli_real_escape_string($con,$_POST['comment']);
		$doctorfname = mysqli_real_escape_string($con,$userRow['doctorFirstName']);
		$doctorlname = mysqli_real_escape_string($con,$userRow['doctorLastName']);
		$doctorwhole = $doctorfname . " ".$doctorlname;
		$doctorId = mysqli_real_escape_string($con,$userRow['doctorId']);
		$username = mysqli_real_escape_string($con,$userRow['username']);
		$select = mysqli_query($con,"SELECT * from service where doctorFirstName ='$doc'");
		$selected = mysqli_fetch_array($select);

		$pfname = $userRow['patientFirstName'];
		$plname = $userRow['patientLastName'];

		$serviceid = $selected['service_id'];
		$service_time = $selected['service_time'];
		$service_name = $selected['service_name'];

		$starttime = $_POST['starttime'];
		$patientname = $pfname ." ". $plname;

		$query = "INSERT INTO schedule (  icPatient ,username, scheduleid, doctorid,scheduleDate ,service_id, servicename ,status, startTime, complain)
		VALUES ( '$patientIc','$username','$scheduleid', '$doctorId', '$appdate','$serviceid','$symptom', default,'$starttime','$comment')";

		//update table appointment schedule

		$result = mysqli_query($con,$query);	
		// echo $result;
		if( $result )
		{
		?>
		<script type="text/javascript">
		alert('Appointment made successfully.');
		window.location.href = 'patientapplist.php';
		</script>
		<?php
		}
		else
		{
		echo mysqli_error($con);
		?>
		<script>
		alert('Appointment booking fail. Please try again.');
		</script>
		<?php
		}
		//dapat dari generator end
		}
		?>
		<?php
		//##########################################################################
		// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
		// Visit www.itexmo.com/developers.php for more info about this API
		//##########################################################################
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
		if(isset($_POST['appointment']))
		{
		/*for patient*/
		$start = date("h:i A",strtotime($starttime));
		$pname = $userRow['patientFirstName'];
		$number = $userRow['patientPhone'];
		$name = "Fernandez Dental Clinic";
		$msg = "Hi"." ".$pname."! "." You have scheduled your appointment on"." ".$appdate." at ".$start.", Please go to the clinic 30 minutes before your appointment Thankyou!.";
		$text = "From: ".$name." 
		".$msg;
		//$api = "TR-VALVE578299_XV4NS";
		$api = "ST-BRYAN151340_9LFL5";

		/*for doctor*/
		$dname = $userRow['doctorFirstName'];
		$fname = $userRow['patientFirstName'];
		$lname = $userRow['patientLastName'];
		$num = $userRow['doctorPhone'];
		$msgs = "Hello"." "."Dr. ".$dname."!"
		." ".$fname." ".$lname." "."made an appointment on"." ".$appdate." at ".$start;


		$result = itexmo($number,$text,$api);
		$textmoto = itexmo($num,$msgs,$api);
		if ($result == "" || $textmoto == ""){
		echo "iTexMo: No response from server!!!
		Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
		Please CONTACT US for help. ";  
		}else if ($result == 0 || $textmoto == 0){
		echo "Message Sent!";
		}
		else{   
		echo "Error Num ". $result . " was encountered!";
		echo "Error Num ". $textmoto . " was encountered!";
		}
		}
		?>
		<!-- For selecting service validation -->
		
		<!-- Bootstrap Core JavaScript -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- USER PROFILE ROW END-->
		<!-- end -->
		</body>

	</html>