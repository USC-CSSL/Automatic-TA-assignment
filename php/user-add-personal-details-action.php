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
		echo $userId;
		
		$sql2="SELECT * FROM `TA` WHERE `User_Id`='$userId'";
		$result2=mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_array($result2);
		if(count($row2)==0)
		{
			$area=$_POST['area'];
			$hasTAexp=$_POST['hasTAexp'];
			$numberSem=$_POST['numberSem'];
			$lastCourse=$_POST['lastCourse'];
			$prevCourses=$_POST['prevCourses'];
			$happy=$_POST['happy'];
			$milestones=$_POST['milestones'];
			#echo "<script> alert($milestones);</script>";
			$courses_string = implode(', ', $prevCourses);
			$milestones_string = implode(', ', $milestones);
			$active=1;
			#echo $courses_string."\n".$happy."\n".$numberSem."\n".$area;
		
			#$sql = "INSERT INTO `ta_project`.`TA` (`User_Id`, `Area`, `Previous_Courses_Taught`, `Course_Taught_Last_Semester`, `Happy_With_Previous_Courses_Taught`, `Has_TA_Experience`, `Has_TA_Experience_For_Number_Of_Semester`, `Milestones_Id`) VALUES ('$userId', '$area', '$courses_string', '$lastCourse', '$happy', '$hasTAexp', '$numberSem', '$milestones_string');";
			$sql="INSERT INTO `ta_project`.`TA` (`User_Id`, `Area`, `Previous_Courses_Taught`, `Course_Taught_Last_Semester`, `Happy_With_Last_Course_Taught`, `Has_TA_Experience`, `Has_TA_Experience_For_Number_Of_Semester`, `Milestones_Id`, `IsActive`) VALUES ('$userId', '$area', '$courses_string', '$lastCourse', '$happy', '$hasTAexp', '$numberSem', '$milestones_string', '$active');";
			$result=mysqli_query($conn,$sql);
		
			if($result)
			{
				echo "<script> alert('Added Personal Details');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-personal.html">';
			}
			else
			{
				echo "<script> alert('Error Adding Personal Details');</script>";
				#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
			}
			
		}
		else
		{
			echo "<script> alert('Personal Details have already been added. Please choose Update option.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-personal.html">';
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

