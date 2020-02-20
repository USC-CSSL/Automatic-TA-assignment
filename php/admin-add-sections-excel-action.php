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
				$courses = explode("-",$courseCode);
                                $s = $courses[1];
                                $result = preg_replace("/[^0-9]+/", "", $s);
                                $courseCode = $courses[0].'-'.$result;		
				$tempCode = $courses[0].' '.$result;				

				$lectlab = $getData[4];
				$code  = $getData[5];
				$code = preg_replace("/[^0-9]+/", "", $code);
				
				if($lectlab === 'Lecture'){
					$leCode = $code;
					$lCode='';
				}			
				elseif($lectlab === 'Lab'){
					$lCode = $code;
				}	
				
				$weekday = $getData[8];
				$days = explode(",",$weekday);
				$len = count($days);
				
				if($len == 1){
					$days = $weekday;
				}
				elseif($len == 2){
					$res = trim($days[0]);
					$res .= trim($days[1]);
					$days = $res;
				}
				
				if($days === 'MonWed'){
					$weekday = "MW";
				}
				elseif($days === 'TueThu'){
					$weekday = "TTh";
				}
				elseif($days === 'MonWedFri'){
					$weekday = "MWF";
				}
				elseif($days === 'Monday'){
					$weekday = "M";
				}
				elseif($days === 'Tuesday'){
					$weekday = "T";
				}
				elseif($days === 'Wednesday'){
					$weekday = "W";
				}
				elseif($days === 'Thursday'){
					$weekday = "Th";
				}
				elseif($days === 'Friday'){
					$weekday = "F";
				}
				elseif($days === 'MonFri'){
					$weekday = 'MF';
				}
				else{
					$weekday = '';
				}
			
				$time = $getData[7];
				$time = explode("-",$time);
				$ampm = preg_replace("/[^a-zA-Z]+/", "", $time[1]);
				$timee = preg_replace("/[^0-9\:]+/", "", $time[1]);
				
				/*
                                if($ampm === 'am'){
                                        $startTime = $time[0].' am';
                                        $endTime = $timee.' am';
                                }
                                else{
                                        $startTime = $time[0].' pm';
                                        $endTime = $timee.' pm';
                                }
				*/

                                $startTime = $time[0];
				if(strlen($startTime) === 4){
					$startTime = '0'.$startTime;
				}
				
				$endTime = $timee;
				if(strlen($endTime) === 4){
                                        $endTime = '0'.$endTime;
                                }
				
				$sql="SELECT * FROM `Course` where `Course_Code` = '$courseCode' or `Course_Code` = '$tempCode'";
                                $result=mysqli_query($conn,$sql);
                                $row=mysqli_fetch_array($result);
                                $id = $row[Course_Id];
				
				if(strlen($id) > 0){
					$courseId = $id;
				}	
				
					
				$type = $lectlab;
				$lectureCode = $leCode;
				$labCode = $lCode;
				$day = $weekday;	
				$start = $startTime;
				$end = $endTime;
				
				// check section id exists
				$sql1 = "SELECT * FROM `Course_Section` WHERE `Lecture_Code`='$lectureCode' and `Lab_Code`='$labCode'";
				$result1 = mysqli_query($conn,$sql1);
				
					
					$row1=mysqli_fetch_array($result1);
					
					if(count($row1)==0){
						
						$sql2="INSERT INTO  `ta_project`.`Time_Intervals` (`Start_Time` ,`End_Time` ,`Day`) VALUES ('$start','$end','$day')";
                                		$result2 = mysqli_query($conn,$sql2);
						
						#add timeslot
                                		if($result2)
                                		{	
							 $sqll = "SELECT * FROM `Time_Intervals` WHERE `Start_Time`='$start' AND `End_Time`='$end' AND `Day`='$day'";
							 $result3 = mysqli_query($conn,$sqll);
							 if($result3)
                                        		 {
							 	$row2=mysqli_fetch_array($result3);
                                                		$timeId=$row2['Time_Slot_Id'];
								
								if($type=="Lecture")
		                                                {
                		                                        $isLecture=1;
                                		                        $labCode="";
                                                		}
  		                                              	else
                		                                {
                                		                        $isLecture=0;
                                                		}
								
								 $sql4="INSERT INTO `Course_Section` (`Course_Id`,`IsLecture`,`Lecture_Code`,`Lab_Code`,`Time_Slot_Id`,`IsActive`) VALUES('$courseId','$isLecture','$lectureCode','$labCode','$timeId','1')";
                                                		 $result4 = mysqli_query($conn,$sql4);
				
							 }
						}
					}
		
			}

			echo "<script> alert('New Sections got Added');</script>";
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./admin-view-sections.php">';
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
