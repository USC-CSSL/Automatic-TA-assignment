<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET['user_id']))
	{
		$userId=$_GET['user_id'];
		$sql1 = "SELECT * FROM `User` WHERE User_Id ='$userId'";
		$result1 = mysqli_query($conn,$sql1);
		$row1 = mysqli_fetch_array($result1);
		
		$sql2 = "SELECT * FROM `TA` WHERE User_Id ='$userId'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		
		$sql3 = "SELECT * FROM `Milestones` WHERE Milestone_Id ='".$row2['Milestone_Id']."'";
		$result3 = mysqli_query($conn,$sql3);
		$row3 = mysqli_fetch_array($result3);
		
	}
	else
	{
		$userId="empty";	
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
		<li class="active"><a href="../html/admin-users.html">Users</a></li>
		<li><a href="../html/admin-courses.html">Courses</a></li> 
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
				  <li><a href="../html/admin-users.html">Users</a></li> 
				  <li><a href="admin-view-users.php">View Users</a></li>
				  <li class="active">Update User Details</li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Update User Details</h3><center><br>
				<form>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="User_Id">User Id</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="number" class="form-control" id="User_Id" placeholder="User Id"></div>
				  </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="name">Name</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="name" placeholder="Name" value="<?php echo $row1['Name'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="username">Username</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $row1['Username'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="area">Area</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="area" placeholder="Area" value="<?php echo $row2['Area'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="hasTAexp">Has TA Experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select class="form-control" id="hasTAexp">
				    	<?php
				    		if($row2['Has_TA_Experience']==1)
				    		{
				    			echo "<option select='selected'>Yes</option><option>No</option>";
				    		}
				    		else
				    		{
				    			echo "<option>Yes</option><option select='selected'>No</option>";
				    		}
				    	?>
					      
					</select>
				   </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="noOfSem">Number of Semesters (of TA Experience)</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="noOfSem" placeholder="Number of Semesters" value="<?php echo $row2['Has_TA_Experience_For_Number_Of_Semester'];?>"></div>
				  </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="noOfSem">Number of Semesters (of TA Experience)</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select name="previousCoursesTaught[]" multiple="multiple">
				    		<?php
				    			sql1="SELECT `Course_Code` and "
				    		?>
				    	</select>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="form-check">
				      <label class="form-check-label">
					<input class="form-check-input" type="checkbox"> Check me out
				      </label>
				    </div>
				  </div>
				  <button type="submit" class="btn btn-primary">Sign in</button>
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
