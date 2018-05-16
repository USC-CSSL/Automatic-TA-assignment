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
			?>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center>
					<h3>Update Time Constraints</h3>
				<center>
				<br>
				<form method="post" action="user-update-time-constraint-action.php?constraint_id=<?php echo $constraintId;?>">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="time">Time Slot</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="time" name="time">
				    	<?php
				    		$sql="SELECT * FROM Time_Intervals";
				    		$result=mysqli_query($conn,$sql);
						$sql1="SELECT * FROM TA_Time_Constraints WHERE Constraint_Id='$constraintId'";
						$result1=mysqli_query($conn,$sql1);
						$row1=mysqli_fetch_array($result1);
				    		if($result)
				    		{
				    			while($row=mysqli_fetch_array($result))
				    			{
								if($row['Time_Slot_Id']==$row1['Time_Interval_Not_Available_Id'])
								{
				    					echo "<option selected value=".$row['Time_Slot_Id'].">".$row['Start_Time']." - ".$row['End_Time']." ".$row['Day']."</option>";
				    				}
								else
								{	echo "<option value=".$row['Time_Slot_Id'].">".$row['Start_Time']." - ".$row['End_Time']." ".$row['Day']."</option>";
				    				
								}
							}
				    		}
				    		
				    	?>
				    	
					</select>
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