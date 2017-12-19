<?php
	include('dbConnect.php');
	session_start();
	if(isset($_GET['preference_id']))
	{
		$preferenceId=$_GET['preference_id'];
	}
	else
	{
		$preferenceId=0;
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
				  <li><a href="user-view-preferences.php">View Preferences</a></li>
				  <li class="active">Update Preference</a></li>
				</ol>
			</div>
			<div class="container">
			<?php if($preferenceId!=0)
				{
					$s="SELECT * FROM TA_Preferences WHERE `Id`='$preferenceId'";
					$r=mysqli_query($conn,$s);
					$row1=mysqli_fetch_array($r);
					$sectionId=$row1['Section_Id'];
					
					$sql="SELECT * FROM Course_Section WHERE `Section_Id`='$sectionId'";
					$result=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($result);
					$courseId=$row['Course_Id'];

					$sql2="SELECT Course_Code as courseCode FROM Course WHERE `Course_Id`='$courseId'";
					$result2=mysqli_query($conn,$sql2);
					$row2=mysqli_fetch_array($result2);
					
					switch($row1['Interest_Level'])
					{
						case '5': $select5="selected";break;
						case '4': $select4="selected";break;
						case '3': $select3="selected";break;
						case '2': $select2="selected";break;
						case '1': $select1="selected";break;
						default : $select5="selected";
					}
			?>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center>
					<h3>Update Preference</h3>
				<center>
				<br>
				<form method="post" action="user-update-preference-action.php?preference_id=<?php echo $preferenceId;?>">
				  <div class="form-row">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><label><?php echo $row2['courseCode']."  ".$row['Lecture_Code'];?></label></div>
				   	<div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    		<select required class="form-control" id="time" name="interestLevel">
				    			<option <?php echo $select5;?> value="5">High</option>
							<option <?php echo $select4;?> value="4">High-Medium</option>
							<option <?php echo $select3;?> value="3">Medium</option>
							<option <?php echo $select2;?> value="2">Medium-Low</option>
							<option <?php echo $select1;?> value="1">Low</option>
						</select>
				  	 </div>				  
				   </div> 
				   <br><br>
				  <input type="submit" name="submit" class="btn btn-primary" value="Submit"></input> 
				 <!-- <input type="submit" name="submit-add" class="btn btn-primary" value="Submit and Add"></input>--> 
				</form>
				<br><br><br>
			</div>
			<?php } ?>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</body>
</html>	
