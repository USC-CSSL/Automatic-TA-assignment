<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
		$filename=$_FILES["file"]["tmp_name"];
		$filesize=$_FILES["file"]["size"];

		if( $filesize > 0)
     		{
			$file = fopen($filename, "r+");
			fgetcsv($file);
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           		{
				$courseCode = $getData[0];
				$courseName = $getData[1];
				$active=1; 
			
				$courses = explode("-",$courseCode);
				$s = $courses[1];
					
				$result = preg_replace("/[^0-9]+/", "", $s);	
				
				$courseCode = $courses[0].'-'.$result;
				$tempCode = $courses[0].' '.$result;
				
				if($courseCode != '-'){
				
					$query = "SELECT * FROM `Course` WHERE `Course_Code`='$courseCode' or `Course_Code`='$tempCode'";
                			
					$result1 = mysqli_query($conn,$query);
                			$r = mysqli_num_rows($result1);
						
					
					if($r==0)
		                	{
                        			$area='';
                        			$half='';
                        			$full='';
                        		
						$sql="INSERT INTO `ta_project`.`Course` (`Course_Code`, `Course_Name`, `Area`, `IsActive`, `Number_Of_Half_TA`, `Number_Of_Full_TA`) VALUES ('$courseCode', '$courseName', '$area', '$active', '$half', '$full');";
                        			$result=mysqli_query($conn,$sql);
                			
					}
				}
			}
			echo "<script> alert('New Courses got Added');</script>";
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin-view-courses.php">';
			
		}
		else{
		 	echo "<script> alert('Please upload a proper CSV file');</script>";
                	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
		}
		
	}
	else
	{
		echo "<script> alert('Please upload a proper CSV file');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin-courses.html">';
	}
?>
