<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$doctorid = $_POST['ig'];
// echo $appid;

$delete = mysqli_query($con,"UPDATE doctor set stats ='Active' WHERE doctorid=$doctorid");


// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

