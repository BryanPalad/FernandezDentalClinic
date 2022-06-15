<?php
include ('assets/conn/dbconnect.php');
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$sql = "SELECT username FROM patientinfo WHERE username = '$username'";
	$result = mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		echo "<b style = 'color:#ff0000;'>"."Username already taken"."</b>";
	}else{
		echo "<b style ='color:#008000;'>"."Available username"."</b>";
	}
}
?>