<?php
include('dbConnect.php');
session_start();
	
if(isset($_POST['submit']))
{
	$interest=$_POST['interestLevel'];
	$preferenceId=$_GET['preference_id'];
	echo $preferenceId;
	echo $interest;
	$sql="UPDATE `TA_Preferences` SET `Interest_Level`='$interest' WHERE `Id`='$preferenceId'";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
		echo "<script> alert('Updated Preference');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-preferences.php">';
	}
	else
	{
		echo "<script> alert('Error Updating Preference');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-preferences.php">';
	}
		
}
else
{
	echo "<script> alert('Error Updating Preference');</script>";
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-view-preferences.php">';
}

?>
