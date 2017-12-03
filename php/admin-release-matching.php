<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["release"]))
	{
		if($_GET["release"])
		{
			$_SESSION['Release_Matching']=1;
			echo "<script> alert('Matching Released');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-matching.html">';
		}
		else
		{
			unset($_SESSION['Release_Matching']);
			echo "<script> alert('Matching Blocked');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-matching.html">';
		}
				
	}
	else
	{
		echo "<script> alert('Incorrect release command');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

