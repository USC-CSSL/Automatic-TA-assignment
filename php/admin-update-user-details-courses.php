<?php
	include('dbConnect.php');
	session_start();
	if (isset($_POST['submit']))
	{
		#echo "HI";
		$userId=$_GET["user_id"];
		$name=$_POST["Name"];
		$username=$_POST["Username"];
		$area=$_POST["Area"];
		$hasTAexp=$_POST["hasTAexp"];
		#echo $hasTAexp;
		
			$sql1="UPDATE `User` SET `Name`='$name',`Username`='$username' WHERE `User_Id`='$userId'";
			$sql2="UPDATE `TA` SET `Area`='$area',`Previous_Courses_Taught`='N/A', `Happy_With_Previous_Courses_Taught`='N/A', `Has_TA_Experience`='0', `Has_TA_Experience_For_Number_Of_Semester`='0' WHERE `User_Id`='$userId'";
			
			$result1=mysqli_query($conn,$sql1);
			$result2=mysqli_query($conn,$sql2);
			if($result1 and $result2) 
		        {
			 	#echo $result;
			 	if($hasTAexp =="No")
				{
					echo "<script> alert('Updated');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
				}
		        }
		        else 
		        {
				 $error = "Error in Update";
				 echo "<script> alert('$error');</script>";
				 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
		        }
		
		/*
		else if($hasTAexp =="Yes" )
		{
			if(isset($_GET['check']))
			{
				echo "<script> alert('YESS');</script>";
				$prevCourses=$_POST['prevCourses'];
				$happy=$_POST['happy'];
				$numberSem=$_POST['number'];
				$milestone=$_POST['milestone'];
				#$ranking=$_POST['ranking'];
				if($happy=="Yes")
				{
					$h=1;
				}
				else
				{
					$h=0;
				}
				$sql3="SELECT * FROM `Milestone` WHERE `Milestone_Name'=$milestone";
				$result3=mysqli_query($conn,$sql3);
				$milID=$result3['Milestone_Id'];
				$sql1="UPDATE `User` SET `Name`='$name',`Username`='$username' WHERE `User_Id`='$userId'";
				$sql2="UPDATE `TA` SET `Area`=$area',`Previous_Courses_Taught`='$prevCourses', `Happy_With_Previous_Courses_Taught`='$h', `Has_TA_Experience`='1', `Has_TA_Experience_For_Number_Of_Semesters`='$numberSem', `Milestone_Id`='$milID' WHERE `User_Id`='$userId'";
			
				$result1=mysqli_query($conn,$sql1);
				$result2=mysqli_query($conn,$sql2);
				if($result1 and result2) 
				{
				 	#echo $result;
				 
					echo "<script> alert('Updated');</script>";
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-users.php">';
				}
				else 
				{
					 $error = "Error in Update";
					 echo $error;
				}
			}
		
		}*/
		
			
	}
	else
	{
		echo "<script> alert('Incorrect Post');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-user-s.php">';
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
				<form method="post" action="admin-update-user-details-courses-yes.php?user_id=<?php echo $userId;?>">
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="User_Id">User Id</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="number" disabled class="form-control" value="<?php echo $userId;?>" disabled name="User_Id" id="User_Id" placeholder="User Id"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="name">Name</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="name" placeholder="Name" name="Name"  disabled  value="<?php echo $name;?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="username">Username</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="username" placeholder="Username" name="Username" disabled value="<?php echo $username;?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="area">Area</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input type="text" class="form-control" id="area" placeholder="Area" name="Area" disabled  value="<?php echo $area;?>"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="hasTAexp">Has TA Experience</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select class="form-control"  disabled id="hasTAexp" name="hasTAexp">
				    	<?php
				    		echo "<option select='selected' name='Yes'>Yes</option>";
				    		
				    	?>
					</select>
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
							echo "<option>".$row['Course_Code']."</option>";						
 						}
 						
				    	?>
					</select>
				   </div>
				   <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="happy">Happy With Previous Courses Taught <mark>*Seperate by comma*</mark></label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required type="text" class="form-control" id="happy" placeholder="Happy With Previous Courses Taught" name="happy"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><label for="number">Number of Semesters (with TA experience)</label></div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6"><input required  type="number" class="form-control" id="number" placeholder="Number of Semesters" name="number"></div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<label for="milestone">Milestone</label>
				    </div>
				    <div class="form-group col-lg-6 col-sm-6 col-xs-6 col-md-6">
				    	<select required class="form-control"  id="milestone" name="milestone">
				    	<?php
				    		$sql3 = "SELECT * FROM `Milestones`";
				    		$result3 = mysqli_query($conn,$sql3);
				    		
				    		while($row1 = mysqli_fetch_array($result3))
						{
							echo "<option>".$row1['Milestone_Name']."</option>";	
						}
				    	?>
					</select>
				   </div>
				   
				  <center><input type="submit" name="submit" class="btn btn-primary" value="Update"></input> </center>
	
				</form>
				
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
