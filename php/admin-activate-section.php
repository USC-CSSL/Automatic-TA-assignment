<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["section_id"]))
	{
		$sectionId=$_GET['section_id'];
		$active=1;
		$sql="UPDATE `Course_Section` SET `IsActive`='$active' WHERE `Section_Id`='$sectionId'";
		$result=mysqli_query($conn,$sql);
		if($result)
		{
			#echo "<script> alert('Deactivation done');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
		}
		else
		{
			
			echo "<script> alert('Error Activation of Course Section');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
			#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		
		}
		
	}
	else
	{
		echo "<script> alert('Incorrect section id');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

