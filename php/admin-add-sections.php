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
				  <li class="active">Add Sections</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Add Sections</h3><center><br>
				<form method="post" action="admin-add-sections-action.php">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="courseCode">Course Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="courseCode" name="courseCode">
				    	<?php
				    		$sql="SELECT * FROM Course";
				    		$result=mysqli_query($conn,$sql);
				    		if($result)
				    		{
				    			while($row=mysqli_fetch_array($result))
				    			{
				    				echo "<option value=".$row[Course_Id].">".$row['Course_Code']."</option>";
				    			}
				    		}
				    		
				    	?>
				    	
					</select>
				   </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="type">Type</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="type" name="type">
				    		<option >Lecture</option>
				    		<option >Lab</option>
				    		
					</select>
				   </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="day">Day</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control" id="day" name="day">
				    		<option >MW</option>
				    		<option >TTh</option>
				    		<option >MWF</option>
				    		<option >M</option>
				    		<option >T</option>
				    		<option >W</option>
				    		<option >Th</option>
				    		<option >F</option>
				    		
					</select>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="lectureCode">Lecture Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="lectureCode" placeholder="Lecture Code" name="lectureCode"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="labCode">Lab Code</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="labCode" placeholder="Lab Code" name="labCode"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="start">Start Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="start" placeholder="Start Time" name="start"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="end">End Time</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="end" placeholder="End Time" name="end"></div>
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
