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
		<li class="active"><a href="../html/user-personal.html">Personal</a></li>
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
				  <li><a href="../html/user-personal.html">Personal</a></li> 
				  <li class="active">Add Personal Details</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Add Personal Details</h3><center><br>
				<form method="post" action="user-add-personal-details-action.php">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="area">Area</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" name="area" id="area" placeholder="Area"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="hasTAexp">Previous TA Experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    <select required class="form-control" id="hasTAexp" name="hasTAexp">
				    		<option value='1'>Yes</option>
				    		<option value='0'>No</option>
				    </select>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="numberSem">Number of Semesters of TA experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="number" class="form-control" id="numberSem" placeholder="Number of Semesters" name="numberSem"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="prevCourses">Previous Courses Taught<br><mark>*Select multiple if applicable*</mark></label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select class="form-control"  required id="prevCourses" name="prevCourses[]" multiple="multiple">
				    	<?php
				    		$sql = "SELECT * FROM `Course`";
				    		$result = mysqli_query($conn,$sql);
				    		
				    		while($row = mysqli_fetch_array($result))
						{
							echo "<option value=".$row['Course_Id'].">".$row['Course_Code']."</option>";						
 						}
 						
				    	?>
				    	<option>N/A</option>
					</select>
				   </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="lastCourse">Course Taught Last Semester</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select class="form-control"  required id="lastCourse" name="lastCourse">
				    	<?php
				    		$sql = "SELECT * FROM `Course`";
				    		$result = mysqli_query($conn,$sql);
				    		
				    		while($row = mysqli_fetch_array($result))
						{
							echo "<option value=".$row['Course_Id'].">".$row['Course_Code']."</option>";						
 						}
 						
				    	?>
				    	<option value='0'>N/A</option>
					</select>
				   </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<label for="happy">Happy with Last Course Taught</label>
				    </div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="happy" name="happy">
				    		<option value='1'>Yes</option>
				    		<option value='0'>No</option>
				    		<option value='0'>N/A</option>
				    	</select>
				    </div>
				  </div>
				  
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="milestones">Milestone</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="milestones" name="milestones[]">
				    		<?php
				    		$sql = "SELECT * FROM `Milestones`";
				    		$result = mysqli_query($conn,$sql);
				    		
				    		while($row = mysqli_fetch_array($result))
						{
							echo "<option value=".$row['Milestone_Id'].">".$row['Milestone_Name']."</option>";						
 						}
 						
				    	?>
				    		
					</select>
				   </div>
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Add"></input> 
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
