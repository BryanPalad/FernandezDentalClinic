<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['id'];
// echo $appid;
$selected = mysqli_query($con,"SELECT a.*,b.*,c.* from schedule a join patientinfo b on a.icPatient = b.icPatient join doctor c on a.doctorid = c.doctorid where appointmentid = $appid");
$select = mysqli_fetch_array($selected);

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
$pfname = $select['patientFirstName'];
$plname = $select['patientLastName'];
$starttime = date("h:i A",strtotime($select['startTime']));
$dfname = $select['doctorFirstName'];
	$dphone = $select['doctorPhone'];
	$name = "Fernandez Dental Clinic";
	$msgs = "Hello"." "."Dr. ".$dfname."!"
		." ".$pfname." ".$plname." "."cancelled an appointment on"." ".$sched." at ".$starttime;
	//$api = "TR-VALVE578299_XV4NS";
	$api = "ST-BRYAN151340_9LFL5";


$result = itexmo($dphone,$msgs,$api);
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
Please CONTACT US for help. ";  
}else if ($result == 0){
echo "Message Sent!";
}
else{   
echo "Error Num ". $result . " was encountered!";
}
	

$delete = mysqli_query($con,"DELETE FROM schedule WHERE appointmentid=$appid");
?>

