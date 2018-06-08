<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET['section_id']))
	{
		$section_id=$_GET['section_id'];
		$sql1 = "SELECT * FROM `Course_Section` WHERE `Section_Id` ='$section_id'";
		$result1 = mysqli_query($conn,$sql1);
		$row1 = mysqli_fetch_array($result1);	
        
        $courseId = $row1['Course_Id'];
        $sql2 = "SELECT * FROM `Course` WHERE `Course_Id`='$courseId'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
        
                
        $timeSlotId=$row1['Time_Slot_Id'];
		$sql3="SELECT * FROM `Time_Intervals` WHERE `Time_Slot_Id`=$timeSlotId";
		$result3=mysqli_query($conn,$sql3);
		$row3 = mysqli_fetch_array($result3);
	}
	else
	{
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-sections.php">';	
	}
	
?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Admin Dashboard</title>
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
	      <a class="navbar-brand" href="../html/admin.html">Admin Dashboard</a>
	      <!--<a class="navbar-brand" href="#"><img src="../images/usc.jpg" style="width: 50px;height:50px;"></img></a>-->
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
		<li><a href="../html/admin.html">Home</a></li>
		<li><a href="../html/admin-users.html">Users</a></li>
		<li class="active"><a href="../html/admin-courses.html">Courses</a></li> 
		<li><a href="../html/admin-matching.html">Matching</a></li> 
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
				  <li><a href="../html/admin-courses.html">Courses</a></li>
				  <li><a href="admin-view-sections.php">View Sections</a></li> 
				  <li class="active">Update Course Section</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Update Course Section</h3><center><br>
				<form method="post" action="admin-update-section-details-action.php?section_id=<?php echo $section_id;?>">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="Course_Code">Course Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input disabled type="text" class="form-control" name="Course_Code" id="Course_Code" placeholder="Course Code" value="<?php echo $row2['Course_Code'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="type">Type</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    <select required class="form-control" name="Type" id="type">
				    	<option <?php if($row1['IsLecture']==0) echo 'selected'?> >Lab</option>
				    	<option <?php if($row1['IsLecture']==1) echo 'selected'?> >Lecture</option>
				    </select>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="lecture_code">Lecuture Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required class="form-control" id="lecture_code" name="Lecture_Code" value="<?php echo $row1['Lecture_Code'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="lab_code">Lab_Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input class="form-control" id="lab_code" name="Lab_Code" value="<?php echo $row1['Lab_Code'];?>"></div>
				  </div>
                  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="day">Day</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="day" name="day">
				    		<option <?php if($row3['Day']=="MW") echo 'selected'?>>MW</option>
				    		<option <?php if($row3['Day']=="TTh") echo 'selected'?>>TTh</option>
				    		<option <?php if($row3['Day']=="MWF") echo 'selected'?>>MWF</option>
				    		<option <?php if($row3['Day']=="M") echo 'selected'?>>M</option>
				    		<option <?php if($row3['Day']=="T") echo 'selected'?>>T</option>
				    		<option <?php if($row3['Day']=="W") echo 'selected'?>>W</option>
				    		<option <?php if($row3['Day']=="Th") echo 'selected'?>>Th</option>
				    		<option <?php if($row3['Day']=="F") echo 'selected'?>>F</option>
				    		
					</select>
				    </div>
				  </div>
                  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="start">Start Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="start" placeholder="Start Time" name="start" value='<?php echo $row3['Start_Time'] ?>'></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="end">End Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="time" class="form-control" id="end" placeholder="End Time" name="end" value='<?php echo $row3['End_Time'] ?>'></div>
				  </div>
				  
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Update"></input> 
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
		
	</body>
</html>
