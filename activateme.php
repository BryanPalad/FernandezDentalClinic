<?php
	require_once ('assets/conn/dbconnect.php');
	if(!empty($_GET["id"])) {
	$query = "UPDATE patient set status = '1' WHERE id='" . $_GET["id"]. "'";
	$result = $db->query($query);
		if(!empty($result)) {
			echo "Your account is activated.";
		} else {
	               echo "Problem in account activation.";
		}
	}
?>