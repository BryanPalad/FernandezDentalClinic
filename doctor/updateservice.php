<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$service = $_POST['ig'];
// echo $appid;
$gg = $_GET['servicetime'];
$delete = mysqli_query($con,"UPDATE service set service_time =$gg where service_id =$service");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

