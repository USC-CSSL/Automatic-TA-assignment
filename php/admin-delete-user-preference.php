<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["ta_id"]))
	{
		$taId=$_POST["ta_id"];
		$sectionId=$_POST["section_id"];
		
		$sql1="DELETE FROM `TA_Preferences` WHERE `TA_Id`='$taId' and `Section_Id`='$sectionId'";
			
			$result1=mysqli_query($conn,$sql1);
			
			if($result1)
			{
				echo "<script> alert('Record Deleted.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
				
				
			}
			else
			{
				echo "<script> alert('Error Deleting record from Admin Matching Table.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
			}
	
		
	}
