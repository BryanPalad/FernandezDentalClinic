<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['id'];
// echo $appid;

$delete = mysqli_query($con,"UPDATE schedule set status = 'cancelled' WHERE appointmentid=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }
$sql = mysqli_query($con,"SELECT a.*,b.* from schedule a join patientinfo b on a.icPatient = b.icPatient WHERE a.appointmentid = $appid");
$select = mysqli_fetch_array($sql);

function itexmo($number,$message,$apicode){
$url = 'https://www.itexmo.com/php_api/api.php';
$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
$param = array(
'http' => array(
'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
'method'  => 'POST',
'content' => http_build_query($itexmo),
),
);
$context  = stream_context_create($param);
return file_get_contents($url, false, $context);}
//##########################################################################
$sched = $select['scheduleDate'];
$pname = $select['patientFirstName'];
$starttime = $select['startTime'];
	$number = $select['patientPhone'];
	$name = "Fernandez Dental Clinic";
	$msg = "Hi"." ".$pname."! "." Your appointment has been cancelled on this day,"." ".$sched.", Kindly reschedule your appointment another day, Thankyou!.";
	$text = "From: ".$name." 
	".$msg;
	$api = "ST-BRYAN151340_9LFL5";


$result = itexmo($number,$text,$api);
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
Please CONTACT US for help. ";  
}else if ($result == 0 || $textmoto == 0){
echo "Message Sent!";
}
else{   
echo "Error Num ". $result . " was encountered!";
echo "Error Num ". $textmoto . " was encountered!";
}
	
?>
