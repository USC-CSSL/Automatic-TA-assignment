<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$time=$_POST['time'];
		$r=$_POST['reason'];
		$constraintId=$_GET['constraint_id'];
		if($_POST['reason']==4)
		{
			$reason=$_POST['reasonIfOther'];
		}
		else
		{
			$reason="";
		}
	
		$sql3="UPDATE `TA_Time_Constraints` SET `Time_Interval_Not_Available_Id`='$time',`Reason_Id`='$r',`Reason_If_Other`='$reason' WHERE `Constraint_Id`='$constraintId'";
		$result3=mysqli_query($conn,$sql3);
		if($result3)
		{
			echo "<script> alert('Updated Time Constraint');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-time-contraints.php">';
		}
		else
		{
			echo "<script> alert('Error Updating Time Constraint');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-time-contraints.php">';
		}
		
	}
	else
	{
			echo "<script> alert('Error Updating Time Constraint');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-time-contraints.php">';
	}

?>		
