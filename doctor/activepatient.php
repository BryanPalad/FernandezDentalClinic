<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$icPatients = $_POST['ig'];
// echo $appid;

$delete = mysqli_query($con,"UPDATE patientinfo set status ='Active' WHERE icPatient=$icPatients");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

