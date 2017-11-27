<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$courseCode=$_POST['Course_Code'];
		$courseName=$_POST['Name'];
		$area=$_POST['Area'];
		$half=$_POST['Half'];
		$full=$_POST['Full'];
		$p1=$_POST['p1'];
		$p2=$_POST['p2'];
		
		$sql = "INSERT INTO `Course` (`Course_Code`,`Course_Name`,`Area`,`Number_Of_Half_TA`,`Number_Of_Full_TA`,`Preference1`,`Preference2`) VALUES('$courseCode','$courseName','$area','$half','$full','$p1','$p2')";
		
		$result=mysqli_query($conn,$sql);
		
		if($result)
		{
			echo "<script> alert('New Course Added');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
		}
		else
		{
			echo "<script> alert('Error Adding Course');</script>";
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

