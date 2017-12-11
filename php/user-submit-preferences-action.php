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
		echo $taId;
		$flag=0;
		$sql3="SELECT * FROM `TA_Preferences` where `TA_Id`='$taId'";
		$result3=mysqli_query($conn,$sql3);
		$row3=mysqli_fetch_array($result3);
		#echo "<script> alert(".count($row3).");</script>";
		if(count($row3)==0)
		{
		
			$sql4="SELECT * FROM `Course_Section` WHERE `IsActive`=1 and `IsLecture`=1";
			$result4=mysqli_query($conn,$sql4);
			
			while($row4=mysqli_fetch_array($result4))
			{
				$sectionId=$row4['Section_Id'];
				$preferenceLevel=$_POST['Pref-'.$sectionId];
				$hasBeenTA=$_POST['Been-'.$sectionId];
				echo $preferenceLevel;
				echo $hasBeenTA;
				if($hasBeenTA=="-1" or $preferenceLevel=="-1")
				{
					
					echo "<script> alert('Please select from valid options');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-submit-preferences.php">';
					$flag=1;
					//echo "Flag: ".$flag;
					break;
				}
				else
				{
					echo $preferenceLevel;
					echo $hasBeenTA;
				
					$sql="INSERT INTO `ta_project`.`TA_Preferences` (`TA_Id`,`Section_Id`,`Has_Been_TA_For_This_Course`,`Interest_Level`) VALUES ('$taId','$sectionId','$hasBeenTA','$preferenceLevel')";
					$result=mysqli_query($conn,$sql);
					#$row=mysqli_fetch_array($result);
					if($result)
					{
						//echo "<script> alert('Submitted for Course ".$courseCode."');</script>";
					}
					else
					{
						echo "<script> alert('Error Submitting for Section ".$sectionId."');</script>";
						#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
					}
				}
				
			
			}
			//echo "Submitted";
			if($flag==0)
			{
				echo "<script> alert('Successfully Submitted Preferences');</script>";
				#header('Location: ' . $_SERVER["HTTP_REFERER"] );
				#exit;
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user-courses.html">';
			}
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

