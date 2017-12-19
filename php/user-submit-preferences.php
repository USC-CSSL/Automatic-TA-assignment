<?php
	include('dbConnect.php');
	session_start();
	$username=$_SESSION['Username'];
	
	$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1);
	
	$userId=$row1['User_Id'];
	$sql="SELECT * FROM `TA` WHERE `User_Id`='$userId'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);

	if($row['TA_Id']=="" or $row['TA_Id']==0)
	{
		$set=0;
	}
	else
	{
		$set=1;
	}
		
	$sql2="SELECT * FROM `Course` WHERE `IsActive`=1 ORDER BY `Course_Code`";
	$result2=mysqli_query($conn,$sql2);
	
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
				  <li class="active">Submit Course Preferences</a></li>
				</ol>
			</div>
			<div class="container">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<?php
					if($set==1){
				?>
				<center><h3>Submit Course Preferences</h3><center><br>
				<form method="post" action="user-submit-preferences-action.php">
				<?php
					while($row2=mysqli_fetch_array($result2))
					{
						$courseId=$row2['Course_Id'];
						$sql3="SELECT * FROM `Course_Section` WHERE `Course_Id`='$courseId' AND `IsLecture`=1";
						$result3=mysqli_query($conn,$sql3);
						while($row3=mysqli_fetch_array($result3))
						{
						echo "
						<div class='form-row'>
						    <div class='form-group col-lg-4 col-sm-4 col-xs-4 col-md-4'>
						    	<label for='preference'>Course Code : ".$row2['Course_Code']." Lecture Code : ".$row3['Lecture_Code']."</label> 
						    </div>
						    
						    <div class='form-group col-lg-2 col-sm-2 col-xs-2 col-md-2'>
						    	<select required class='form-control' id='preference' name='Pref-".$row3['Section_Id']."'>
						    		<option value='-1' selected='selected' disabled>Select</option>
						    		<option value='5'>High</option>
						    		<option value='4'>High-Medium</option>
						    		<option value='3'>Medium</option>
						    		<option value='2'>Medium-Low</option>
						    		<option value='1'>Low</option>
						    	</select>
						    </div>
						</div>	
						";
						}
						/*<div class='form-group col-lg-3 col-sm-3 col-xs-3 col-md-3'>
						    	<label for='preference'>Been TA for this Course Before</label>
						    </div>
						    <div class='form-group col-lg-3 col-sm-3 col-xs-3 col-md-3'>
						    	<select required class='form-control' id='preference' name='Been-".$row2['Section_Id']."'>
						    		<option value='-1' selected='selected' disabled>Select</option>
						    		<option value='1'>Yes</option>
						    		<option value='0'>No</option>
						    		
						    	</select>
						    </div>
						    <br>
						";*/
						#echo "Been-".$row2['Course_Code']."1";
					}
				?>
				  
				<div class="form-group col-lg-2 col-sm-2 col-xs-2 col-md-2 col-lg-offset-5 col-sm-offset-5 col-xs-offset-5 col-md-offset-5">
						<center><input type="submit" name="submit" class="btn btn-primary" value="Submit"></input> </center>
				</div>
				
				</form>
				<?php
					}
					else
					{
						echo "<center><h3>Please add personal details before submitting course preferences.</h3></center>";
					}
				?>
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
