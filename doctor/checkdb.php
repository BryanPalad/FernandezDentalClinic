<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];
$remarks = $_GET['remarks'];

$update = mysqli_query($con,"UPDATE schedule SET status='done' WHERE appointmentid=$userid");


$select = mysqli_query($con,"SELECT a.*,b.* from patientinfo a INNER join schedule b on a.username = b.username where b.appointmentid
	 =$userid");
$selected = mysqli_fetch_array($select);

$selected_row = $selected['icPatient'];

mysqli_query($con,"UPDATE patientinfo set patient='Old' where icPatient =$selected_row");

?>