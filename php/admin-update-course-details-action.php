<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST['submit']))
	{
		$courseId=$_GET['course_id'];
		$courseCode=$_POST['Course_Code'];
		$courseName=$_POST['Name'];
		$area=$_POST['Area'];
		$half=$_POST['Half'];
		$full=$_POST['Full'];
		echo $courseId;
		
		$sql1="UPDATE `Course` SET `Course_Code`='$courseCode', `Course_Name`='$courseName', `Area`='$area', `Number_Of_Half_TA`='$half', `Number_Of_Full_TA`='$full' WHERE `Course_Id`='$courseId'";
		$result1=mysqli_query($conn,$sql1);
		if($result1) 
	        {
		 	echo "<script> alert('Updated');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
			
	        }
	        else 
	        {
			 $error = "Error in Update";
			 echo "<script> alert('$error');</script>";
			 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-courses.php">';
	        }
			
	}
	else
	{
		echo "<script> alert('Incorrect Post');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-user-s.php">';
	}
?>
