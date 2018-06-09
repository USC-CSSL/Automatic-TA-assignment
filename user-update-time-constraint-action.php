<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST["submit"]))
	{
        $time;
		$day=$_POST['day'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        
        $sql = "SELECT * FROM `Time_Intervals` WHERE `Start_Time`='$start' AND `End_Time`='$end' AND `Day`='$day'";
		$result = mysqli_query($conn,$sql);
        if($result){
            $row1=mysqli_fetch_array($result);
            echo $row1;
            if(count($row1)==0){
                $sql2="INSERT INTO `ta_project`.`Time_Intervals` (`Start_Time` ,`End_Time` ,`Day`) VALUES ('$start','$end','$day')";
				$result2 = mysqli_query($conn,$sql2);
				#add timeslot
				if($result2)
				{
					#echo "<script> alert('3');</script>";
					
					$result4 = mysqli_query($conn,$sql);
					#get the timeslot id
					if($result4)
					{
						
						$row2=mysqli_fetch_array($result4);
						$time=$row2['Time_Slot_Id'];
					}
					else
					{
						echo "<script> alert('Error Getting Timeslot After Adding New Slot');</script>";
						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user-update-time-constraint.php">';
					}
                } 
            } else {
                $time=$row1['Time_Slot_Id'];
            }
        } else {
            echo "<script> alert('Error Checking if Timeslot exists before adding new');</script>";
        }
        
        
        
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
