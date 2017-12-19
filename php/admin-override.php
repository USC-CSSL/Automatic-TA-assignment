<?php
	include('dbConnect.php');
	session_start();
?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Admin Dashboard</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link  type="text/javascript"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
		<link href="../css/admin.css" type="text/css" rel="stylesheet">
		<link href="../js/admin.js" type="text/javascript">
		<script src="../js/jquery-cookie-master/src/jquery.cookie.js"></script>
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
		<li><a href="#">Home</a></li>
		<li><a href="../html/admin-users.html">Users</a></li>
		<li><a href="../html/admin-courses.html">Courses</a></li> 
		<li class="active"><a href="../html/admin-matching.html">Matching</a></li> 
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
		<li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		
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
				  <li><a href="../html/admin-matching.html">Matching</a></li>
				  <li class="active">Add TA - Course (Admin Override)</li>
				</ol>
			</div>
			<!--<div class="row">-->
			<div class="row">
				<div class="container">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<center><h3>Add TA - Course</h3><center><br>
					<form method="post" action="admin-override-action.php">
					  <div class="form-row">
					    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="ta">Teaching Assistant</label></div>
					    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    		<select required class='form-control' id='ta' name='ta'>
						    		
						    <?php
						    	$active=1;
						    	$sql="SELECT * FROM `TA` WHERE `IsActive`=1";
							$result=mysqli_query($conn,$sql);
						    	if($result)
						    	{
						    		while($row=mysqli_fetch_array($result))
						    		{
						    			$userId=$row['User_Id'];
						    			$sql1="SELECT * FROM `User` WHERE `User_Id`='$userId'";
									$result1=mysqli_query($conn,$sql1);
									$row1=mysqli_fetch_array($result1);
						    			echo "<option value=".$row['TA_Id'].">".$row1['Name']." | TA_Id: ".$row['TA_Id']."</option>";
						    		}
							}
							else
							{
							 	echo "<option>N/A</option>";
							}
						    ?>
						    	
						</select>
					    </div>
					  </div>
				  	<div class="form-row">
					    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="section">Section</label></div>
					    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    		<select required class='form-control' id='section' name='section'>
						    		
						    <?php
						    	$active=1;
						    	$sql="SELECT * FROM `Course` ORDER BY Course_Code";
							$result=mysqli_query($conn,$sql);
						    	if($result)
						    	{
						    		while($row=mysqli_fetch_array($result))
						    		{
						    			$courseId=$row['Course_Id'];
						    			$sql1="SELECT * FROM `Course_Section` WHERE `Course_Id`='$courseId' ORDER BY Lecture_Code,Lab_Code";
									$result1=mysqli_query($conn,$sql1);
									while($row1=mysqli_fetch_array($result1))
									{
									if($row1['IsActive'])
									{
										if($row1['Lab_Code']=="")
										{
											echo "<option value=".$row1['Section_Id'].">".$row['Course_Code']." - Lecture : ".$row1['Lecture_Code']." Lab : N/A</option>";
										}
										else
										{
											echo "<option value=".$row1['Section_Id'].">".$row['Course_Code']." - Lecture : ".$row1['Lecture_Code']." Lab : ".$row1['Lab_Code']."</option>";
										}
									}
						    			}
						    		}
							}
							else
							{
							 	echo "<option>N/A</option>";
							}
						    ?>
						    	
						</select>
					    </div>
					  </div>
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Add"></input> 
				</form>
				<br><br><br>
			</div>
			</div>
			</div>
			
		</div>
	</div>
	</body>
</html>
