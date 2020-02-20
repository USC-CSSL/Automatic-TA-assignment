<?php
	session_start();
	
	$response = array();
	if (! (isset($_SESSION['status']) && $_SESSION['status'] == true)) {
		$response['status'] = false;
	}
	else{
		$response['status'] = true;
	}
	echo json_encode($response);

?>

