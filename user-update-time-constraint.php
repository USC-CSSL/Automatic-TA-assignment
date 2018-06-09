<?php
	include('dbConnect.php');
	session_start();
	if(isset($_GET['constraint_id']))
	{
		$constraintId=$_GET['constraint_id'];
	}
	else
	{
		$constraintId=0;
	}
	
?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="UTF-8">
		<title>User Dashboard</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
		<link href="../css/admin.css" type="text/css" rel="stylesheet">
		<link href="../js/admin.js" type="text/javascript">
		<!--<script src="../js/jquery-cookie-master/src/jquery.cookie.js"></script>-->
	</head>
	<body>
	<!-- NAVBAR -->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span> 
	      </button>
	      <a class="navbar-brand" href="../html/user.html">User Dashboard</a>
	      <!--<a class="navbar-brand" href="#"><img src="../images/usc.jpg" style="width: 50px;height:50px;"></img></a>-->
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
		<li><a href="../html/user.html">Home</a></li>
		<li class="active"><a href="../html/user-personal.html">Background</a></li>
		<li><a href="../html/user-courses.html">Courses</a></li> 
		<li><a href="../html/user-matching.html">Matching</a></li> 
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<img src="../images/uscheader.png" style="width: 100%;"></img>
			</div>
				
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				<ol class="breadcrumb">
				  <li><a href="../html/user-personal.html">Background</a></li> 
				  <li><a href="user-view-time-contraints.php">View Time Constraints</a></li>
				  <li class="active">Update Constraints</a></li>
				</ol>
			</div>
			<div class="container">
			<?php if($constraintId!=0)
				{
                    $sql1="SELECT * FROM TA_Time_Constraints WHERE Constraint_Id='$constraintId'";
				    $result1=mysqli_query($conn,$sql1);
				    $row1=mysqli_fetch_array($result1);
                    $timeSlotId = $row1['Time_Interval_Not_Available_Id'];    
    
                    $sql2="SELECT * from Time_Intervals where Time_Slot_Id='$timeSlotId'";
                    $result2=mysqli_query($conn,$sql2);
				    $row2=mysqli_fetch_array($result2);

                    $day=$row2['Day'];
                    $start=$row2['Start_Time'];
                    $end=$row2['End_Time'];
    
			?>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center>
					<h3>Update Time Constraints</h3>
				<center>
				<br>
				<form method="post" action="user-update-time-constraint-action.php?constraint_id=<?php echo $constraintId;?>">
				  <div class="form-row">
				    <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="day">Day</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="day" name="day">
				    		<option <?php if($day=="MW")echo 'selected'?> >MW</option>
				    		<option <?php if($day=="TTh")echo 'selected'?>>TTh</option>
				    		<option <?php if($day=="MWF")echo 'selected'?>>MWF</option>
				    		<option <?php if($day=="M")echo 'selected'?>>M</option>
				    		<option <?php if($day=="T")echo 'selected'?>>T</option>
				    		<option <?php if($day=="W")echo 'selected'?>>W</option>
				    		<option <?php if($day=="Th")echo 'selected'?>>Th</option>
				    		<option <?php if($day=="F")echo 'selected'?>>F</option>
				    		
					    </select>
				    </div>
				  </div>
                  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="start">Start Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="start" placeholder="Start Time" name="start" value='<?php echo $row2['Start_Time'] ?>'></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="end">End Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="end" placeholder="End Time" name="end" value='<?php echo $row2['End_Time'] ?>'></div>
				  </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="reason">Reason</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="reason" name="reason">
				    	<?php
				    		$sql="SELECT * FROM Reason";
				    		$result=mysqli_query($conn,$sql);
				    		if($result)
				    		{
				    			while($row=mysqli_fetch_array($result))
				    			{
				    				if($row['Reason_Id']==$row1['Reason_Id'])
								{
									echo "<option selected value=".$row['Reason_Id'].">".$row['Reason']."</option>";
				    				}
								else
								{
									echo "<option value=".$row['Reason_Id'].">".$row['Reason']."</option>";
				    				}
							}
				    		}
				    		
				    	?>	
					</select>
				   </div>
				  
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="reasonIfOther">If Other</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
					<?php
					if($row1['Reason_Id']==4)
					{
					?>
					<input required type="text" class="form-control" id="reasonIfOther1" value="<?php echo $row1['Reason_If_Other'];?>" name="reasonIfOther"></div>
				 	<?php
					}
					else
					 {
					?>
					 <input required type="text" class="form-control" id="reasonIfOther" placeholder="Reason" name="reasonIfOther"></div>
				 	<?php } ?>
				 </div>
				  
				  
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Submit"></input> 
				 <!-- <input type="submit" name="submit-add" class="btn btn-primary" value="Submit and Add"></input>--> 
				</form>
				<br><br><br>
			</div>
			<?php } ?>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	<script type='text/javascript'>
	$(document).ready(function() {
		$('#reasonIfOther').attr('disabled','disabled');        
		$('select[name="reason"]').on('change',function(){
		var  others = $(this).val();
		//console.log(others);
		    if(others == '4')
		    {   
		    	//console.log(others);
		    	$('#reasonIfOther').removeAttr('disabled');          
		    }
		    else
		    {
		     	$('#reasonIfOther').attr('disabled','disabled'); 
		    }  

		  });

		//$('#reasonIfOther').attr('disabled','disabled');        
		$('select[name="reason"]').on('change',function(){
		var  others = $(this).val();
		//console.log(others);
		    if(others == '4')
		    {   
		    	//console.log(others);
		    	$('#reasonIfOther1').removeAttr('disabled');          
		    }
		    else
		    {
		     	$('#reasonIfOther1').attr('disabled','disabled');
			$('#reasonIfOther1').attr('value','Other'); 
		    }  

		  });

		});
	</script>
	</body>
</html>	
