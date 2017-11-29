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
		
		$sql2="SELECT * FROM `TA` where `User_Id`='$userId'";
		$result2=mysqli_query($conn,$sql2);
		$row2=mysqli_fetch_array($result2);
	
		$taId=$row2['TA_Id'];
		
		$sql3="SELECT * FROM `TA_Preferences` where `TA_Id`='$taId'";
		$result3=mysqli_query($conn,$sql3);
		$row3=mysqli_fetch_array($result3);
		#echo "<script> alert(".count($row3).");</script>";
		if(count($row3)==0)
		{
		
			$sql4="SELECT * FROM `Course`";
			$result4=mysqli_query($conn,$sql4);
		
			while($row4=mysqli_fetch_array($result4))
			{
				$courseId=$row4['Course_Id'];
				$courseCode=$row4['Course_Code'];
			
				$preferenceLevel=$_POST['Pref-'.$courseCode];
				$hasBeenTA=$_POST['Been-'.$courseCode];
				#echo "<script> alert(".$_POST['Been-PSYC-360'].");</script>";
				#echo "<script> alert($_POST['Been-'.$courseCode]);</script>";
				$sql="INSERT INTO `ta_project`.`TA_Preferences` (`TA_Id`,`Course_Id`,`Has_Been_TA_For_This_Course`,`Interest_Level`) VALUES ('$taId','$courseId','$hasBeenTA','$preferenceLevel')";
				$result=mysqli_query($conn,$sql);
				#$row=mysqli_fetch_array($result);
				if($result)
				{
					#echo "<script> alert('Submitted for Course ".$courseCode."');</script>";
				}
				else
				{
					#echo "<script> alert('Error Submitting for Course ".$courseCode."');</script>";
					#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
				}
			
			}
			echo "<script> alert('Successfully Submitted Preferences');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
			#exit;
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-courses.html">';
		}
		else
		{	
			echo "<script> alert('Preferences have already been recorded.');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
			#exit;
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-courses.html">';
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

