<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['id'];
// echo $appid;

$delete = mysqli_query($con,"UPDATE testimonials set status = 'disapproved' WHERE id=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }
?>