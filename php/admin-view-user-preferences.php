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
		<li  class="active"><a href="../html/admin-users.html">Users</a></li> 
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
				  <li><a href="../html/admin-users.html">Courses</a></li> 
				  <li class="active">View Submitted Preferences</li>
				  
				</ol>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Submitted Preferences</h3><center>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				<table class="table table-responsive ">
				    <thead>
					<tr>
					    <th><center>TA ID</center></th>
					    <th><center>TA Name</center></th>
					    <th><center>Course</center></th>
					    <th><center>Preference Level</center></th>
					    <th><center>Have Been TA For This Course</center></th>
					    
					</tr>
				    </thead>

				    <tbody><?php
				    		
						$sql="SELECT * FROM `TA_Preferences`";
						$result=mysqli_query($conn,$sql);
							
							
						while($row=mysqli_fetch_array($result))
						{
							$sql4="SELECT * FROM `TA` where `TA_Id`='".$row['TA_Id']."'";
							$result4=mysqli_query($conn,$sql4);
							$row4=mysqli_fetch_array($result4);	
							$userId=$row4['User_Id'];
							
							$sql1="SELECT * FROM `User` where `User_Id`='".$userId."'";
							$result1=mysqli_query($conn,$sql1);
							$row1=mysqli_fetch_array($result1);
							$name=$row1['Name'];
							
							$sql2="SELECT * FROM `Course_Section` where `Section_Id`='".$row['Section_Id']."'";
							$result2=mysqli_query($conn,$sql2);
							$row2=mysqli_fetch_array($result2);
							
							$sql3="SELECT * FROM `Course` where `Course_Id`='".$row2['Course_Id']."'";
							$result3=mysqli_query($conn,$sql3);
							$row3=mysqli_fetch_array($result3);

							if($row['Has_Been_TA_For_This_Course']==1)
							{	
								$hasBeen="Yes";
							}		    	
							else
							{
								$hasBeen="No";
							}
							echo    "
								    <tr>
								    	<td><center>".$row['TA_Id']."</center></td>
					    				<td><center>".$name."</center></td>
									<td><center>".$row3['Course_Code']." ".$row2['Lecture_Code']."</center></td>
									<td><center>".$row['Interest_Level']."</center></td>
									<td><center>".$hasBeen."</center></td>
									
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
				<br><br><br>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</body>
</html>
