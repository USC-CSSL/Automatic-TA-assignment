<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET["release"]))
	{
		$file="release.txt";
		$f=fopen($file,"w") or die("Die");
		if($_GET["release"]==1)
		{
			//$_SESSION['Release_Matching']=1;
			//echo "HI ".$file."  ".$f;
			fwrite($f,"1");
			echo "<script> alert('Matching Released');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-matching.html">';
		}
		else
		{
			//unset($_SESSION['Release_Matching']);
			fwrite($f,"0");
			echo "<script> alert('Matching Blocked');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-matching.html">';
		}
		sleep(1);
		fclose($f);
	}
	else
	{
		echo "<script> alert('Incorrect release command');</script>";
		#header('Location: ' . $_SERVER["HTTP_REFERER"] );
		#exit;
		#echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-add-courses.php">';
	}
?>

