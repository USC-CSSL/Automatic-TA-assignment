<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["matching"]) and $_GET["matching"]=="admin")
	{
		
		$sql="DELETE from `Admin_Matching`";
		$result=mysqli_query($conn,$sql);
		echo $result;
		if($result)
		{
			#echo "<script> alert('Activation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-matching.php">';
		}
		else
		{
			
			echo "<script> alert('Error Deleting');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	else if (isset($_GET["matching"]) and $_GET["matching"]=="algorithm")
	{
		$sql="DELETE FROM `Matching`";
		$result=mysqli_query($conn,$sql);
		echo $result;
		if($result)
		{
			#echo "<script> alert('Activation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-matching.php">';
		}
		else
		{
			
			echo "<script> alert('Error Deleting');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	else
	{
		echo "<script> alert('Incorrect matching source');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

