<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["course_id"]))
	{
		$courseId=$_POST["course_id"];
		$sql1="DELETE FROM `Course` WHERE `Course_Id`='$courseId'";
		$sql2="DELETE FROM `Course_Section` WHERE `Course_Id`='$courseId'";
		
		$result1=mysqli_query($conn,$sql1);
		$result2=mysqli_query($conn,$sql2);
			
		if($result1)
		{
			if($result2)
			{
				echo "<script> alert('Record Deleted.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
			}
			else
			{	
				echo "<script> alert('Error Deleting record from Course_Section Database.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
			}
		}
		else
		{
			echo "<script> alert('Error Deleting record from Course and Course_Section Database.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
		}
		
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
	}
?>

