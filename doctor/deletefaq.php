<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$icPatient = $_POST['if'];
// echo $appid;
$delete = mysqli_query($con,"DELETE from faq WHERE id=$icPatient");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

