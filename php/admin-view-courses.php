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
				  <li class="active">View Courses</li>
				  
				</ol>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>View Course Details</h3><center>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				<table class="table table-responsive ">
				    <thead>
					<tr>
					    <th><center>Course Id</center></th>
					    <th><center>Course Code</center></th>
					    <th><center>Course Name</center></th>
					    <th><center>Area</center></th>
					    <th><center>Action</center></th>
					</tr>
				    </thead>

				    <tbody><?php
				    		
						$query1="SELECT * FROM `Course`";
						$result1=mysqli_query($conn,$query1);
						$records_flag=False;
						
						while($row1 = mysqli_fetch_array($result1))
						{
										    	
							echo    "
								    <tr>
									<td><center>".$row1['Course_Id']."</center></td>
									<td><center>".$row1['Course_Code']."</center></td>
									<td><center>".$row1['Course_Name']."</center></td>
									<td><center>".$row1['Area']."</center></td>
									<td>
										<center>
										<!-- Split button -->
										<div class='btn-group'>
										  <button type='button' class='btn btn-primary'>Action</button>
										  <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
										    <span class='caret'></span>
										    <span class='sr-only'>Toggle Dropdown</span>
										  </button>
										  <ul class='dropdown-menu'>
										    <li><a href='admin-view-course-details.php?course_id=".$row1['Course_Id']."'>View</a></li>
										    <li role='separator' class='divider'></li>
										    <li><a href='admin-update-course-details.php?course_id=".$row1['Course_Id']."'>Update</a></li>
										    <li role='separator' class='divider'></li>
										    <li>
										    
										    <a href='admin-delete-course.php?course_id=".$row1['Course_Id']."'>Delete</a></li>
										  </ul>
										</div>
										</center>
									</td>
								    </tr>
								";

				    		
				    			$records_flag=True;
						}
						
						if($records_flag==False)
						{
							echo 	"
										<div class='container col-lg-12 col-md-12 col-xs-12 col-sm-12'>
											<div class='col-lg-12 col-md-12 col-xs-12 col-sm-12'>
												<center>No Records Found</center>
											</div>
										</div>
							
									";
						}
						//*/			
					?>		    	
				   </tbody>
				</table>
				
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</body>
</html>
