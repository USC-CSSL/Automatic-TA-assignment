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
				  <li class="active">View Sections</li>
				  
				</ol>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>View Section Details</h3><center>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
			<?php
			$sql1="SELECT * FROM `Course_Section` INNER JOIN `Course` ON `Course_Section`.`Course_Id` = `Course`.`Course_Id` ORDER BY Course_Code";
			$result1=mysqli_query($conn,$sql1);
			$r=count(mysqli_fetch_array($result1));
			if($r!=0)
			{
			?>
				<table class="table table-responsive ">
				    <thead>
					<tr>
					    <th><center>Section Id</center></th>
					    <th><center>Course Code</center></th>
					    <th><center>Type</center></th>
					    <th><center>Lecture Code</center></th>
					    <th><center>Lab Code</center></th>
					    <th><center>Start Time</center></th>
					    <th><center>End Time</center></th>
					    <th><center>Day</center></th>
					   
					</tr>
				    </thead>

				    <tbody><?php
				    		
						
						while($row1 = mysqli_fetch_array($result1))
						{
							$timeSlotId=$row1['Time_Slot_Id'];
							$sql2="SELECT * FROM `Time_Intervals` WHERE `Time_Slot_Id`=$timeSlotId";
							$result2=mysqli_query($conn,$sql2);
							$row2 = mysqli_fetch_array($result2);
								
							$courseId=$row1['Course_Id'];
							#echo $courseId;
							$sql3="SELECT * FROM `Course` WHERE `Course_Id`='$courseId'";
							$result3=mysqli_query($conn,$sql3);
							$row3 = mysqli_fetch_array($result3);
							
							if($row1['IsLecture']==1)
							{
								$type="Lecture";
							}
							else
							{
								$type="Lab";
							}
							if($row3['IsActive']==1)
							{			    	
								echo    "
								    <tr>
									<td><center>".$row1['Section_Id']."</center></td>
									<td><center>".$row3['Course_Code']."</center></td>
									<td><center>".$type."</center></td>
									<td><center>".$row1['Lecture_Code']."</center></td>
									<td><center>".$row1['Lab_Code']."</center></td>
									<td><center>".$row2['Start_Time']."</center></td>
									<td><center>".$row2['End_Time']."</center></td>
									<td><center>".$row2['Day']."</center></td>
									
								    </tr>
								";
								
								
							}
							
				    			
						}
								
					?>		    	
				   </tbody>
				</table>
				<?php
				}
				else
				{
					echo 	"	<div class='container col-lg-12 col-md-12 col-xs-12 col-sm-12'>
											<div class='col-lg-12 col-md-12 col-xs-12 col-sm-12'>
												<center>No Records Found</center>
											</div>
										</div>
							
									";
				}
				?>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	function confirmDelete(sectionId)
	{
		if (confirm('Are you sure you want to delete this Section?')) {
		    //Make ajax call
		    $.ajax({
		        url: "admin-delete-section.php",
		        type: "POST",
		        data: {section_id : sectionId},
		        dataType: "html", 
		        success: function() {
		            alert("Succesfully deleted section!");
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
