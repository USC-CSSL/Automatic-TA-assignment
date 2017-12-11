<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$courseCode=$_POST['Course_Code'];
		//check of course exists
		echo $courseCode;
		$query="SELECT * FROM `Course` WHERE `Course_Code`='$courseCode'";
		
		$result1=mysqli_query($conn,$query);
		$r=mysqli_num_rows($result1);
		//echo $row;
		
		if($r==0)
		{
			$courseName=$_POST['Name'];
			$area=$_POST['Area'];
			$half=$_POST['Half'];
			$full=$_POST['Full'];
			$active=1;
			echo $courseName;
			echo $area;
			echo $half;
			echo $full;
			$sql="INSERT INTO `ta_project`.`Course` (`Course_Code`, `Course_Name`, `Area`, `IsActive`, `Number_Of_Half_TA`, `Number_Of_Full_TA`) VALUES ('$courseCode', '$courseName', '$area', '$active', '$full', '$full');";
			//$sql="INSERT INTO `ta_project`.`Course` (`Course_Code`, `Course_Name`, `Area`, `Active`, `Number_Of_Half_TA`, `Number_Of_Full_TA`) VALUES ('$courseCode', '$courseName', '$area', '$active', '$half', '$full');";
			$result=mysqli_query($conn,$sql);
			echo $result;
			
			if($result)
			{
				echo "<script> alert('New Course Added');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
			}
			else
			{
			
				echo "<script> alert('Error Adding Course');</script>";
				//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
				#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
			}
		}
		else
		{
			echo "<script> alert('Course Already Exists');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
		}
		
		
	}
	else
	{
		echo "<script> alert('Incorrect Submit');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

