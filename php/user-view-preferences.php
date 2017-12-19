<?php
	include('dbConnect.php');
	session_start();
	$username=$_SESSION['Username'];
	$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1);
        //echo $username;	
	$userId=$row1['User_Id'];
	
	$sql2="SELECT * FROM `TA` where `User_Id`='$userId'";
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_array($result2);

	$taId=$row2['TA_Id'];
	if($taId==0 or $taId=="")
	{
		$flagEmpty=1;
	}
	else
	{
		$sql3="SELECT * FROM `TA_Preferences` where `TA_Id`='$taId'";
		$result3=mysqli_query($conn,$sql3);
		if(mysqli_num_rows($result3)==0)
		{
			$noPref=1;
		}
		else
		{
			$noPref=0;
		}
	}
	//echo $taId;
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
		<li  class="active"><a href="../html/user-courses.html">Courses</a></li> 
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
				  <li class="active">View Submitted Preferences</li>
				  
				</ol>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Submitted Preferences</h3><center>
			</div>
			
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				<?php 
					if($flagEmpty!=1 and $noPref!=1)
					{
						
				?>
				<table class="table table-responsive ">
				    <thead>
					<tr>
					    <th><center>Course and Section</center></th>
					    <th><center>Preference Level</center></th>
					    <th><center>Update</center></th>
					</tr>
				    </thead>

				    <tbody><?php
				    		$records_flag=False;
						while($row3 = mysqli_fetch_array($result3))
						{
							$sql4="SELECT * FROM `Course_Section` where `Section_Id`='".$row3['Section_Id']."'";
							$result4=mysqli_query($conn,$sql4);
							$row4=mysqli_fetch_array($result4);	
							
							$sql5="SELECT * FROM `Course` where `Course_Id`='".$row4['Course_Id']."'";
							$result5=mysqli_query($conn,$sql5);
							$row5=mysqli_fetch_array($result5);	
							if($row3['Has_Been_TA_For_This_Course']==1)
							{	
								$hasBeen="Yes";
							}		    	
							else
							{
								$hasBeen="No";
							}
							switch ($row3['Interest_Level']) {
							    case '5':
								$i="High";
								break;
							    case '4':
								$i="High-Medium";
								break;
							    case '3':
								$i="Medium";
								break;
							    case '2':
								$i="Medium-Low";
								break;
							    case '1':
								$i="Low";
								break;
							    default:
								$i="Low";
								
							}
							echo    "
								    <tr>
									<td><center>".$row5['Course_Code']." ".$row4['Lecture_Code']."</center></td>
									<td><center>".$i."</center></td>
									<td><center><a class='btn btn-primary'  href='user-update-preference.php?preference_id=".$row3['Id']."'>Update</a></center></td>
								   </tr>
								";
								/*
								"	<td><center>".$hasBeen."</center></td>
									
								    </tr>
								";

				    				*/
				    			$records_flag=True;
						}
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
