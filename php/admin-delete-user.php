<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["user_id"]))
	{
		$userId=$_POST["user_id"];
		$sql1="DELETE FROM `User` WHERE `User_Id`='$userId'";
		$sql2="DELETE FROM `TA` WHERE `User_Id`='$userId'";
			
		$result1=mysqli_query($conn,$sql1);
		$result2=mysqli_query($conn,$sql2);
			
		if($result1)
		{
			if($result2)
			{
				echo "<script> alert('Record Deleted.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
			}
			else
			{	
				echo "<script> alert('Error Deleting record from TA Database.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
			}
		}
		else
		{
			echo "<script> alert('Error Deleting record from User and TA Database.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
			
		
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
	}
?>

