<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$username=$_SESSION['Username'];
		$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_array($result1);
		$userId=$row1['User_Id'];
				
		$area=$_POST['area'];
		$hasTAexp=$_POST['hasTAexp'];
		$numberSem=$_POST['numberSem'];
		
		$prevCourses=$_POST['prevCourses'];
		$happy=$_POST['happy'];
		$milestones=$_POST['milestones'];
		#echo "<script> alert($milestones);</script>";
		$courses_string = implode(', ', $prevCourses);
		$milestones_string = implode(', ', $milestones);
		if($hasTAexp==0)
		{	
			$numberSem=0;
			$courses_string="N/A";
			$happy="N/A";
			$numberSem=0;
			
		}
		echo $courses_string."\n".$happy."\n".$numberSem."\n".$area;
		
		$sql="UPDATE `TA` SET `Area`='$area',`Previous_Courses_Taught`='$courses_string', `Happy_With_Previous_Courses_Taught`='$happy', `Has_TA_Experience`='$hasTAExp', `Has_TA_Experience_For_Number_Of_Semester`='$numberSem', `Milestones_Id`='$milestones_string' WHERE `User_Id`='$userId'";
		
		#$sql = "UPDATE `ta_project`.`TA` SET `Area`='$area',`Previous_Courses_Taught`='$courses_string', `Happy_With_Previous_Courses_Taught`='$happy', `Has_TA_Experience`='$hasTAexp', `Has_TA_Experience_For_Number_Of_Semester`='$numberSem', `Milestones_Id`='$milestones_string') WHERE `User_Id`='$userId';";
		
		$result=mysqli_query($conn,$sql);
		
		if($result)
		{
			echo "<script> alert('Updated Personal Details');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-personal.html">';
		}
		else
		{
			echo "<script> alert('Error Updating Personal Details');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
		
	}
	else
	{
		echo "<script> alert('Incorrect Submit');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

