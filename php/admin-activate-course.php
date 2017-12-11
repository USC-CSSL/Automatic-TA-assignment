<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["course_id"]))
	{
		$courseId=$_GET['course_id'];
		$active=1;
		$sql="UPDATE `Course` SET `IsActive`='$active' WHERE `Course_Id`='$courseId'";
		$result=mysqli_query($conn,$sql);
		$sql1="UPDATE `Course_Section` SET `IsActive`='$active' WHERE `Course_Id`='$courseId'";
		$result1=mysqli_query($conn,$sql1);
		if($result and $result1)
		{
			#echo "<script> alert('Deactivation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
		}
		else
		{
			
			echo "<script> alert('Error Deactivation of Course');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	else
	{
		echo "<script> alert('Incorrect course id');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

