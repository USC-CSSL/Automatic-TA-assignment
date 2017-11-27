<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST['submit']))
	{
		$userId=$_GET["user_id"];
		$prevCourses=$_POST['prevCourses'];
		$happy=$_POST['happy'];
		$numberSem=$_POST['number'];
		$milestone=$_POST['milestone'];
		$string_prevCourses = implode(',', $prevCourses);
		
		if($happy=="Yes")
		{
			$h=1;
		}
		else
		{
			$h=0;
		}
		
		$sql="SELECT * FROM `Milestones` WHERE `Milestone_Name`='$milestone'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		if($result)
		{
			$milID=$row['Milestone_Id'];
			$sql1="UPDATE `TA` SET `Previous_Courses_Taught`='$string_prevCourses', `Happy_With_Previous_Courses_Taught`='$h', `Has_TA_Experience`='1', `Has_TA_Experience_For_Number_Of_Semester`='$numberSem' WHERE `User_Id`='$userId'";
			
	
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
			echo "<script> alert('No milestone id received');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
		
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';	
	}
?>

