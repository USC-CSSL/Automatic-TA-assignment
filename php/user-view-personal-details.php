<?php
	include('dbConnect.php');
	session_start();
	$username=$_SESSION['Username'];
	#echo $username;	
	$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1);

	$userId=$row1['User_Id'];
	#echo $userId;	
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
		<li><a href="../html/user.html">Home</a></li>
		<li class="active"><a href="../html/user-personal.html">Personal</a></li>
		<li ><a href="../html/user-courses.html">Courses</a></li> 
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
				  <li class="active">View Personal Details</li>
				  
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Personal Details</h3><center><br>
				<table class="table" style="width:60%;">
				    <tbody>
					<tr>
					  <th>Username</th>
					    <td><?php echo $row1['Username'];?></td>
					</tr>
					<tr>
					  <th>Area</th>
					    <td><?php echo $row2['Area'];?></td>
					</tr>
				      	<tr>
					  <th>Has TA Experience</th>
					    <td><?php 
						    if($row2['Has_TA_Experience'])
						    {
						    	echo "Yes";
						    }
						    else
						    {
						    	echo "No";
						    };
						?></td>
					</tr>
					<tr>
					  <th>Number of Semesters of TA Experience</th>
					    <td><?php echo $row2['Has_TA_Experience_For_Number_Of_Semester'];?></td>
					</tr>
					<tr>
					  <th>Previous Courses Taught</th>
					    <td><?php 
					    	$courses=explode(",",$row2['Previous_Courses_Taught']);
					    	$flag=0;
					    	foreach ($courses as $c)
					    	{
					    		if($flag!=0)
							{
								echo "<br>";
							}
					    		$sql3="SELECT * FROM `Course` WHERE `Course_Id`='$c'";
							$result3=mysqli_query($conn,$sql3);
							$row3=mysqli_fetch_array($result3);
							echo $row3['Course_Name'];
							if($flag==0)
							{
								$flag=1;
							}
							
							
					    	}
					    	#echo $row2['Number_Of_Full_TA'];?></td>
					</tr>
					<tr>
					  <th>Courses Taught Last Semester</th>
					    <td><?php echo $row2['Course_Taught_Last_Semester'];?></td>
					</tr>
					<tr>
					  <th>Happy With Last Course Taught</th>
					    <td><?php 
					    	if($row2['Happy_With_Last_Course_Taught'])
					    	{
					    		echo "Yes";
					    	}
					    	else
					    	{
					    		echo "No";
					    	}
					    	?></td>
					</tr>
					<tr>
					  <th>Milestones</th>
					    <td><?php 
					    	$milestones=explode(",",$row2['Milestones_Id']);
					    	foreach ($milestones as $m)
					    	{
					    		$sql3="SELECT * FROM `Milestones` WHERE `Milestone_Id`='$m'";
							$result3=mysqli_query($conn,$sql3);
							$row3=mysqli_fetch_array($result3);
							echo $row3['Milestone_Name'];
							echo "<br>";
					    	}
					    	#echo $row2['Number_Of_Full_TA'];?></td>
					</tr>
					
					
				    </tbody>
				</table>
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
