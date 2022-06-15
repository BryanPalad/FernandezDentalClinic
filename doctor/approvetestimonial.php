<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"UPDATE testimonials set status = 'approved' WHERE id=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }
?>