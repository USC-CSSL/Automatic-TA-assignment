<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST['submit']))
	{
		$userId=$_GET["user_id"];
		$prevCourses=$_POST['prevCourses'];
		$lastCourse=$_POST['lastCourse'];
		$happy=$_POST['happy'];
		$numberSem=$_POST['number'];
		
		$string_prevCourses = implode(',', $prevCourses);
		
		//$sql="SELECT * FROM `Milestones` WHERE `Milestone_Name`='$milestone'";
		//$result=mysqli_query($conn,$sql);
		//$row=mysqli_fetch_array($result);
		$isactive=1;
		$sql1="UPDATE `TA` SET `Previous_Courses_Taught`='$string_prevCourses', `Course_Taught_Last_Semester`='$lastCourse', `Happy_With_Last_Course_Taught`='$happy', `Has_TA_Experience`='1', `Has_TA_Experience_For_Number_Of_Semester`='$numberSem' WHERE `User_Id`='$userId'";
			

		$result1=mysqli_query($conn,$sql1);
		if($result1) 
		{
		 	echo "<script> alert('Updated');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
		else 
		{
			 $error = "Error in Update";
			 echo $error;
		}
		
		
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';	
	}
?>

