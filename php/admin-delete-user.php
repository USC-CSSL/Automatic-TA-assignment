<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["user_id"]))
	{
		$userId=$_POST["user_id"];
		$sql1="DELETE FROM `User` WHERE `User_Id`='$userId'";
        $ta_id = "SELECT TA_Id from TA where `User_Id`='$userId'";
		$sql2="DELETE FROM `TA` WHERE `User_Id`='$userId'";
        if(!empty($ta_id)) {
            $sql3="DELETE FROM `TA_Time_Constraints` WHERE `TA_Id`='$ta_id'";
            $sql4="DELETE FROM `TA_Preferences` WHERE `TA_Id`='$ta_id'";
            $result3=mysqli_query($conn,$sql3);
		    $result4=mysqli_query($conn,$sql4);
        }
			
		$result1=mysqli_query($conn,$sql1);
		$result2=mysqli_query($conn,$sql2);
			
		if($result1)
		{
			if($result2)
			{
				echo "<script> alert('Record Deleted.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
			}
			else
			{	
				echo "<script> alert('Error Deleting record from TA Database.');</script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
			}
		}
		else
		{
			echo "<script> alert('Error Deleting record from User and TA Database.');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
			
		
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
	}
?>

