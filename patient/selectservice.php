<?php

include_once '../assets/conn/dbconnect.php';
$type_post = (filter_input(INPUT_POST, 'service_name'));

$q = mysql_query("select service_time from service where service_name='" . $type_post . "'") or die(mysql_error());
$service = mysql_fetch_row($q);
$service_value = $service;

?>
 <input type="text"name="doctor" disabled=""class="form-control input-md" style="width:50%;" value="<?php echo $service_value ?>;">