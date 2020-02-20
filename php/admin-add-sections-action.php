<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$courseId=$_POST['courseCode'];
		$type=$_POST['type'];
		$day=$_POST['day'];
		$start=$_POST['start'];
		$start = strtotime($start);
		$start = date('h:i a', $start);
		//echo "<script> alert('$start');</script>";
		$end=$_POST['end'];
		$end = strtotime($end);
                $end = date('h:i a', $end);
		$lectureCode=$_POST['lectureCode'];
		$labCode=$_POST['labCode'];
		// check section id exists
		$sql1 = "SELECT * FROM `Time_Intervals` WHERE `Start_Time`='$start' AND `End_Time`='$end' AND `Day`='$day'";
		$result1 = mysqli_query($conn,$sql1);
		if($result1)
		{
			#echo "<script> alert('1');</script>";
			$row1=mysqli_fetch_array($result1);
			#if timeslot doesn't exist
			if(count($row1)==0)
			{	
				$sql2="INSERT INTO  `ta_project`.`Time_Intervals` (`Start_Time` ,`End_Time` ,`Day`) VALUES ('$start','$end','$day')";
				$result2 = mysqli_query($conn,$sql2);
				#add timeslot
				if($result2)
				{
					#echo "<script> alert('3');</script>";
					
					$result3 = mysqli_query($conn,$sql1);
					#get the timeslot id
					if($result3)
					{
						
						$row2=mysqli_fetch_array($result3);
						$timeId=$row2['Time_Slot_Id'];
						//echo $type;
						
						if($type=="Lecture")
						{
							$isLecture=1;
							$labCode="";
						}
						else
						{
							$isLecture=0;
						}
						
						$sql4="INSERT INTO `Course_Section` (`Course_Id`,`IsLecture`,`Lecture_Code`,`Lab_Code`,`Time_Slot_Id`,`IsActive`) VALUES('$courseId','$isLecture','$lectureCode','$labCode','$timeId','1')";
						$result4 = mysqli_query($conn,$sql4);
						#add section
						if($result4)
						{
							echo "<script> alert('New Section Added');</script>";
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
							//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
						}
						else
						{
							echo "<script> alert('Error Adding Section');</script>";
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
						}
						
					}
					else
					{
						echo "<script> alert('Error Getting Timeslot After Adding New Slot');</script>";
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
					}
					
				}
				else
				{
					echo "<script> alert('Error Adding Timeslot');</script>";
					#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
				}
				
			}
			else
			{
				
				$timeId=$row1['Time_Slot_Id'];
				if($type=="Lecture")
				{
					$isLecture=1;
					$labCode="";
				}
				else
				{
					$isLecture=0;
				}
				$sql4="INSERT INTO `Course_Section` (`Course_Id`,`IsLecture`,`Lecture_Code`,`Lab_Code`,`Time_Slot_Id`,`IsActive`) VALUES('$courseId','$isLecture','$lectureCode','$labCode','$timeId','1')";
				$result4 = mysqli_query($conn,$sql4);
				#add section
				if($result4)
				{
					echo "<script> alert('New Section Added');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
					//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
				}
				else
				{
					echo "<script> alert('Error Adding Section');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
				}
				
				
			}
		}
		else
		{
			echo "<script> alert('Error Checking if Timeslot exists before adding new');</script>";
			#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-sections.php">';
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

