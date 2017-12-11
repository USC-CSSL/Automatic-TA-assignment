<?php
	include('dbConnect.php');
	session_start();
	if (isset($_GET['course_id']))
	{
		$courseId=$_GET['course_id'];
		$sql1 = "SELECT * FROM `Course` WHERE Course_Id ='$courseId'";
		$result1 = mysqli_query($conn,$sql1);
		$row1 = mysqli_fetch_array($result1);
		
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
		<li><a href="../html/user-personal.html">Background</a></li>
		<li class="active"><a href="../html/user-courses.html">Courses</a></li> 
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
				  <li><a href="../html/user-courses.html">Courses</a></li> 
				  <li><a href="user-view-courses.php">View Courses</a></li>
				  <li class="active">View Section Details</li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Course - Section Details</h3><center><br>
				<table class="table" style="width:60%;">
				    <tbody>
					<tr>
					  <th>Course Code</th>
					    <td><?php echo $row1['Course_Code'];?></td>
					</tr>
					<tr>
					  <th>Course Name</th>
					    <td><?php echo $row1['Course_Name'];?></td>
					</tr>
				      	<tr>
					  <th>Area</th>
					    <td><?php echo $row1['Area'];?></td>
					</tr>
					
				    </tbody>
				</table>
				<br><br><br>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Sections</h3><center><br>
				<table class="table" style="width:60%;">
				    <tbody>
					<tr>
						<th>Section ID</th>
						<th>Type</th>
						<th>Lecture Code</th>
						<th>Lab Code</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Day</th>
					</tr>
					<?php
					$sql2 = "SELECT * FROM `Course_Section` WHERE Course_Id ='$courseId'";
					$result2 = mysqli_query($conn,$sql2);
					while($row2 = mysqli_fetch_array($result2))
					{
						$sql3 = "SELECT * FROM `Time_Intervals` WHERE Time_Slot_Id ='".$row2['Time_Slot_Id']."'";
						$result3 = mysqli_query($conn,$sql3);
						$row3 = mysqli_fetch_array($result3);
						if($row2['IsLecture']==1)
						{
							$type="Lecture";
						}
						else
						{
							$type="Lab";
						}
						
						echo "
					
						<tr>
							<td>".$row2['Section_Id']."</td>
							<td>".$type."</td>
							<td>".$row2['Lecture_Code']."</td>
							<td>".$row2['Lab_Code']."</td>
							<td>".$row3['Start_Time']."</td>
							<td>".$row3['End_Time']."</td>
							<td>".$row3['Day']."</td>
							
						</tr>
						
						";
					}
		
					
					?>
					
					
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
