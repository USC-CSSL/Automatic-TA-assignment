<?php
	include('dbConnect.php');
	session_start();
	
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
				  <li class="active">Add Time Constraints</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center>
					<h3>Add Time Constraints</h3>
					<h4>Note: Select timeslots when unavailable between 8:00 AM and 8:00 PM.</h4>
				<center>
				<br>
				<form method="post" action="user-add-time-contraints-action.php">
				  <div class="form-row">
				    <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="day">Day</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="day" name="day">
				    		<option>MW</option>
				    		<option>TTh</option>
				    		<option>MWF</option>
				    		<option>M</option>
				    		<option>T</option>
				    		<option>W</option>
				    		<option>Th</option>
				    		<option>F</option>
				    		
					    </select>
				    </div>
				  </div>
                  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="start">Start Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="start" placeholder="Start Time" name="start"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="end">End Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="end" placeholder="End Time" name="end"></div>
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
				    				echo "<option value=".$row['Reason_Id'].">".$row['Reason']."</option>";
				    			}
				    		}
				    		
				    	?>
				    	
					</select>
				   </div>
				  
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="reasonIfOther">If Other</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="reasonIfOther" placeholder="Reason" name="reasonIfOther"></div>
				  </div>
				  
				  
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Submit"></input> 
				  <input type="submit" name="submit-add" class="btn btn-primary" value="Submit and Add"></input> 
				</form>
				<br><br><br>
			</div>
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
		     	$('#reasonIfOther	').attr('disabled','disabled'); 
		    }  

		  });
		});
	</script>
	</body>
</html>
