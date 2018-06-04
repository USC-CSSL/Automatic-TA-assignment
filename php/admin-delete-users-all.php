<?php
	include('dbConnect.php');
	session_start();

		//echo $ta;
		$active=0;
		$sql="DELETE from `TA`";
		$result=mysqli_query($conn,$sql);
        $sql3="DELETE FROM `TA_Time_Constraints`";
        $sql4="DELETE FROM `TA_Preferences`";
        $sql2="DELETE FROM `User` where `IsAdmin`=0";
        $result3=mysqli_query($conn,$sql3);
        $result4=mysqli_query($conn,$sql4);
        $result2=mysqli_query($conn,$sql2);
		echo $result;
		if($result && $result3 && $result4)
		{
			#echo "<script> alert('Activation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		}
		else
		{
			
			echo "<script> alert('Error Deleting All Users');</script>";
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}

?>

