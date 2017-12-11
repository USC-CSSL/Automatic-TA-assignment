<?php
	include('dbConnect.php');
	session_start();
	$username=$_SESSION['Username'];
	$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1);
	$userId=$row1['User_Id'];
	
	$sql2="SELECT * FROM `TA` WHERE `User_Id`='$userId'";
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_array($result2);
	
	
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
		<li><a href="../html/admin.html">Home</a></li>
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
				  <li class="active">Update Personal Details</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Update Personal Details</h3><center><br>
				<form method="post" action="user-update-personal-details-action.php">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="area">Area</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" name="area" id="area" value="<?php echo $row2['Area'];?>" placeholder="Area"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="hasTAexp">Previous TA experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    <select required class="form-control" id="hasTAexp" name="hasTAexp">
				    		<option value='1'>Yes</option>
				    		<option value='0'>No</option>
				    </select>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="numberSem">Number of semesters of TA experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="number" class="form-control" id="numberSem" value="<?php echo $row2['Has_TA_Experience_For_Number_Of_Semester'];?>" placeholder="Number of Semesters" name="numberSem"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="prevCourses">Previous courses taught<br><mark>*Select multiple if applicable*</mark></label></div>
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
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="lastCourse">Course taught last semester</label></div>
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
				    	<label for="happy">Happy with last course taught</label>
				    </div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="happy" name="happy">
				    		<option value="1">Yes</option>
				    		<option value="0">No</option>
				    		<option value="0">N/A</option>
				    	</select>
				    </div>
				  </div>
				  
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="milestones">Milestone</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="milestones" name="milestones[]" multiple="multiple">
				    		<?php
				    		$sql3 = "SELECT * FROM `Milestones`";
				    		$result3 = mysqli_query($conn,$sql3);
				    		$milestones_string=$row2['Milestones_Id'];
				    		$milestones=explode(",",$milestones_string);
				    		while($row1 = mysqli_fetch_array($result3))
						{
							if(in_array($row1['Milestone_Id'],$milestones))
							{
								echo "<option selected value=".$row1['Milestone_Id'].">".$row1['Milestone_Name']."</option>";	
							}
							else
							{
								echo "<option value=".$row1['Milestone_Id'].">".$row1['Milestone_Name']."</option>";	
							}
						}
				    	?>
				    		
					</select>
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
