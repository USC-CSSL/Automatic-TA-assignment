<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["course_id"]))
	{
		$courseId=$_GET['course_id'];
		$active=1;
		$sql="UPDATE `Course` SET `IsActive`='$active' WHERE `Course_Id`='$courseId'";
		$result=mysqli_query($conn,$sql);
		echo $result;
		if($result)
		{
			echo "<script> alert('Activation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
		}
		else
		{
			
			echo "<script> alert('Error Activation of Course');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	else
	{
		echo "<script> alert('Incorrect course id');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

