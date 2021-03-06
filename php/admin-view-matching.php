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
		<li><a href="../html/admin-courses.html">Courses</a></li> 
		<li class="active"><a href="../html/admin-matching.html">Matching</a></li> 
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
				  <li><a href="../html/admin-matching.html">Matching</a></li> 
				  <li class="active">View Matching</li>
				  
				</ol>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Matching</h3><center>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				<table class="table table-responsive ">
				    <thead>
					<tr>
					    <th><center>Matching Id</center></th>
					    <th><center>TA Id</center></th>
					    <th><center>TA Name</center></th>
					    <th><center>Section Id</center></th>
					    <th><center>Course Code</center></th>
					    <th><center>Lecture Code</center></th>
					    <th><center>Lab Code</center></th>
					    <th><center>Source</center></th>
					    <th><center>Active</center></th>
					    <th><center>Action</center></th>
					</tr>
				    </thead>

				    <tbody><?php
				    		
						$query="SELECT * FROM `Admin_Matching` ORDER BY `TA_Id`";
						$result=mysqli_query($conn,$query);
						$records_flag=False;
						$admin=1;
						while($row = mysqli_fetch_array($result))
						{
							
							$sql1="SELECT * FROM `TA` WHERE `TA_Id`='".$row['TA_Id']."'";
							$result1=mysqli_query($conn,$sql1);
							$row1 = mysqli_fetch_array($result1);
							
							$sql2="SELECT * FROM `User` WHERE `User_Id`='".$row1['User_Id']."'";
							$result2=mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($result2);
							
							$sql3="SELECT * FROM `Course_Section` WHERE `Section_Id`='".$row['Section_Id']."'";
							$result3=mysqli_query($conn,$sql3);
							$row3 = mysqli_fetch_array($result3);
							
							$sql4="SELECT * FROM `Course` WHERE `Course_Id`='".$row3['Course_Id']."'";
							$result4=mysqli_query($conn,$sql4);
							$row4 = mysqli_fetch_array($result4);
							if($row['IsActive'])
							{
							
								echo    "
								    <tr>
									<td><center>".$row['Admin_Matching_Id']."</center></td>
									<td><center>".$row['TA_Id']."</center></td>
									<td><center>".$row2['Name']."</center></td>
									<td><center>".$row['Section_Id']."</center></td>
									<td><center>".$row4['Course_Code']."</center></td>
									<td><center>".$row3['Lecture_Code']."</center></td>
									<td><center>".$row3['Lab_Code']."</center></td>
									<td><center>Admin</center></td>
									<td><center><a class='btn btn-danger' href='admin-deactivate-matching.php?admin_matching_id=".$row['Admin_Matching_Id']."'>Deactivate</a></center></td>
									<td>
									
										<center>
										<a class='btn btn-warning' type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row['Admin_Matching_Id'].",".$admin.");'>Delete</a>
										
										</center>
									</td>
								    </tr>
								";
							/*
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
										    
										    <a type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row['Admin_Matching_Id'].",admin);'>Delete</a>
										  </ul>
										</div>
							*/
							}
							else
							{
								echo    "
								    <tr>
									<td><center>".$row['Admin_Matching_Id']."</center></td>
									<td><center>".$row['TA_Id']."</center></td>
									<td><center>".$row2['Name']."</center></td>
									<td><center>".$row['Section_Id']."</center></td>
									<td><center>".$row4['Course_Code']."</center></td>
									<td><center>".$row3['Lecture_Code']."</center></td>
									<td><center>".$row3['Lab_Code']."</center></td>
									<td><center>Admin</center></td>
									<td><center><a class='btn btn-success' href='admin-activate-matching.php?admin_matching_id=".$row['Admin_Matching_Id']."'>Activate</a></center></td>
									<td>
									
										<center>
										<a class='btn btn-warning' type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row['Admin_Matching_Id'].",".$admin.");'>Delete</a>
										</center>
									</td>
								    </tr>
								";
								/*
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
										    
										    <a type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row1['Course_Id'].");'>Delete</a>
										  </ul>
										</div>
								*/
							}
				    			$records_flag=True;
						}
						
						$query="SELECT * FROM `Matching` ORDER BY `TA_Id`";
						$result=mysqli_query($conn,$query);
						$admin=0;
						while($row = mysqli_fetch_array($result))
						{
							
							$sql1="SELECT * FROM `TA` WHERE `TA_Id`='".$row['TA_Id']."'";
							$result1=mysqli_query($conn,$sql1);
							$row1 = mysqli_fetch_array($result1);
							
							$sql2="SELECT * FROM `User` WHERE `User_Id`='".$row1['User_Id']."'";
							$result2=mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($result2);
							
							$sql3="SELECT * FROM `Course_Section` WHERE `Section_Id`='".$row['Section_Id']."'";
							$result3=mysqli_query($conn,$sql3);
							$row3 = mysqli_fetch_array($result3);
							
							$sql4="SELECT * FROM `Course` WHERE `Course_Id`='".$row3['Course_Id']."'";
							$result4=mysqli_query($conn,$sql4);
							$row4 = mysqli_fetch_array($result4);
							if($row['IsActive'])
							{
							
								echo    "
								    <tr>
									<td><center>".$row['Matching_Id']."</center></td>
									<td><center>".$row['TA_Id']."</center></td>
									<td><center>".$row2['Name']."</center></td>
									<td><center>".$row['Section_Id']."</center></td>
									<td><center>".$row4['Course_Code']."</center></td>
									<td><center>".$row3['Lecture_Code']."</center></td>
									<td><center>".$row3['Lab_Code']."</center></td>
									<td><center>Algorithm</center></td>
									<td><center><a class='btn btn-danger' href='admin-deactivate-matching.php?matching_id=".$row['Matching_Id']."'>Deactivate</a></center></td>
									<td>
										<center>
										<a class='btn btn-warning' type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row['Matching_Id'].",".$admin.");'>Delete</a>
										
										</center>	
									</td>
								    </tr>
								";
								/*
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
										    
										    <a type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row1['Course_Id'].");'>Delete</a>
										  </ul>
										</div>
										</center>
								*/
							
							}
							else
							{
								echo    "
								    <tr>
									<td><center>".$row['Matching_Id']."</center></td>
									<td><center>".$row['TA_Id']."</center></td>
									<td><center>".$row2['Name']."</center></td>
									<td><center>".$row['Section_Id']."</center></td>
									<td><center>".$row4['Course_Code']."</center></td>
									<td><center>".$row3['Lecture_Code']."</center></td>
									<td><center>".$row3['Lab_Code']."</center></td>
									<td><center>Algorithm</center></td>
									<td><center><a class='btn btn-success' href='admin-activate-matching.php?matching_id=".$row['Matching_Id']."'>Activate</a></center></td>
									<td>
									<center><a class='btn btn-warning' type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row['Matching_Id'].",".$admin.");'>Delete</a></center>
										
									</td>
								    </tr>
								";
								/*
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
										    
										    <a type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(".$row1['Course_Id'].");'>Delete</a>
										  </ul>
										</div>
										</center>
								*/
							}
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
				<br>
				<br>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	function confirmDelete(matchId,source)
	{
		console.log("Inside");
		if (confirm('Are you sure you want to delete this Matching?')) {
		//alert(matchId);
		//alert(source);
		    //Make ajax call
		    $.ajax({
		        url: "admin-delete-matching.php",
		        type: "POST",
		        data: {matching_id : matchId, source : source},
		        dataType: "html", 
		        success: function() {
		            //alert("Succesfully deleted course!");
		            location.reload();
		        },
		        failure: function(){
		        	alert("Error in Post");
		        }
		    });

		}
		else
		{
			alert("Delete action cancelled.");
		}
	}
	</script>
	</body>
</html>
