<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST['submit']))
	{
		$sectionId=$_GET['section_id'];
		$lectureCode=$_POST['Lecture_Code'];
        $labCode=$_POST['Lab_Code'];
		$type=$_POST['Type'];
        $isLecture=0;
        if(strcmp($type,"Lecture")==0){
            $isLecture=1;
        }
		$day=$_POST['day'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        
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

						
						$sql4="UPDATE `Course_Section` SET `Lecture_Code`='$lectureCode', `Lab_Code`='$labCode', `IsLecture`='$isLecture', `Time_Slot_Id`='$timeId' WHERE `Section_Id`='$sectionId'";
						$result4 = mysqli_query($conn,$sql4);
						#add section
						if($result4)
						{
							echo "<script> alert('Section Updated');</script>";
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
							//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
						}
						else
						{
							echo "<script> alert('Error Updating Section');</script>";
							echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
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
				
				$sql4="UPDATE `Course_Section` SET `Lecture_Code`='$lectureCode', `Lab_Code`='$labCode', `IsLecture`='$isLecture', `Time_Slot_Id`='$timeId' WHERE `Section_Id`='$sectionId'";
				$result4 = mysqli_query($conn,$sql4);
            
				#add section
				if($result4)
				{
					echo "<script> alert('Section Updated');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
					//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
				}
				else
				{
					echo "<script> alert('Error Updating Section - 90 ".$sql4."');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
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
		echo "<script> alert('Incorrect Post');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
	}
?>
