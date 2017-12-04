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
		echo "<script> alert('No userid');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';	
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
				<form method="post" action="admin-update-user-details-courses.php?user_id=<?php echo $userId;?>">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="User_Id">User Id</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="number" disabled class="form-control" value="<?php echo $userId;?>" name="User_Id" id="User_Id" placeholder="User Id"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="name">Name</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="name" placeholder="Name" name="Name" value="<?php echo $row1['Name'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="username">Username</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="username" placeholder="Username" name="Username" value="<?php echo $row1['Username'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="area">Area</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="area" placeholder="Area" name="Area" value="<?php echo $row2['Area'];?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<label for="milestones">Milestone</label>
				    </div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control"  id="milestones" name="milestones[]" multiple="multiple">
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
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="hasTAexp">Has TA Experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="hasTAexp" name="hasTAexp">
				    	<?php
				    		if($row2['Has_TA_Experience']==1)
				    		{
				    			echo "<option select='selected' name='Yes'>Yes</option><option name='No'>No</option>";
				    		}
				    		else
				    		{
				    			echo "<option select='selected' name='No'>No</option><option name='Yes'>Yes</option>";
				    		}
				    	?>
					      
					</select>
				   </div>
				   <br>
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
