<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$service = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE from service where service_id =$service");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

