<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["constraint_id"]))
	{
		$constraintId=$_POST["constraint_id"];
		echo "HI: ".$constraintId;
		$sql1="DELETE FROM `TA_Time_Constraints` WHERE `Constraint_Id`='$constraintId'";
			
		$result1=mysqli_query($conn,$sql1);
			
		if($result1)
		{
			echo "<script> alert('Record Deleted.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-time-constraints.php">';
				
				
		}
		else
		{
			echo "<script> alert('Error Deleting record from TA Time Constraints Table.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-time-constraints.php">';
		}
	
	}
