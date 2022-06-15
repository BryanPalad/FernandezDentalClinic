<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$icPatient = $_POST['ic'];
// echo $appid;
$delete = mysqli_query($con,"UPDATE patientinfo set status ='Inactive' WHERE icPatient=$icPatient");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

