<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["ta_id"]))
	{
		$ta=$_GET['ta_id'];
		//echo $ta;
		$active=0;
		$sql="UPDATE `TA` SET `IsActive`='$active' WHERE `TA_Id`='$ta'";
		$result=mysqli_query($conn,$sql);
        $sql3="DELETE FROM `TA_Time_Constraints` WHERE `TA_Id`='$ta'";
        $sql4="DELETE FROM `TA_Preferences` WHERE `TA_Id`='$ta'";
        $result3=mysqli_query($conn,$sql3);
        $result4=mysqli_query($conn,$sql4);
        
		echo $result;
		if($result && $result3 && $result4)
		{
			#echo "<script> alert('Activation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
		else
		{
			
			echo "<script> alert('Error DeActivation');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	
	else
	{
		echo "<script> alert('Incorrect user id');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

