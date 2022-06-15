<?php
include ('assets/conn/dbconnect.php');
if(isset($_POST) & !empty($_POST)){

	$patientEmail = mysqli_real_escape_string($con,$_POST['patientEmail']);
	$sql = "SELECT patientEmail FROM patientinfo WHERE patientEmail = '$patientEmail'";
	$result = mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		echo "<b style = 'color:#ff0000;'>"."Email Address already exists"."</b>";
	}else{
		echo "<b style ='color:#008000;'>"."Available Email Address"."</b>";
	}
}
?>