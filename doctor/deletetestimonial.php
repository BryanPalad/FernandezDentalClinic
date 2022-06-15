<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['ig'];
// echo $appid;

$delete = mysqli_query($con,"DELETE from testimonials WHERE id=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }
?>