<?php
	include('dbConnect.php');
	session_start();
	$sections=array();		
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
		<li  class="active"><a href="../html/admin-matching.html">Matching</a></li> 
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
		</div>
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
			<ol class="breadcrumb"> 
				<li><a href="../html/admin-matching.html">Matching</a></li> 
				<li class="active">View Matching Stats</li>
				  
			</ol>
		</div>
			
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
			<center><h3>View Matching Stats</h3><center>
		</div>
			
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<center><h4>Users Matched</h4><center>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="font:#FFF;">
						<br><b>Algorithm</b><br><br><a class="btn btn-success">
					<?php
						$sql="SELECT count(DISTINCT Matching.TA_Id) as total FROM TA, Matching WHERE Matching.TA_Id=TA.TA_Id and TA.IsActive=1 and Matching.IsActive=1";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
                        $total_ta = $data['total'];
						echo $data['total'];

					?>
						</a><br>
					<?php
						$sql="SELECT DISTINCT(User.Name) as name  FROM TA, Matching, User WHERE Matching.TA_Id=TA.TA_Id and TA.User_Id=User.User_Id and TA.IsActive=1 and Matching.IsActive=1";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name'];}

					?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="font:#FFF;">
						<br><b>Admin</b><br><br><a class="btn btn-success">
					<?php
						$sql="SELECT count(DISTINCT Admin_Matching.TA_Id) as total FROM TA, Admin_Matching WHERE Admin_Matching.TA_Id=TA.TA_Id and TA.IsActive=1 and Admin_Matching.IsActive=1";
						$result=mysqli_query($conn,$sql);
						$data1=mysqli_fetch_assoc($result);
                        $total_ta+=$data1['total'];
						echo $data1['total'];

					?>
						</a><br>
					<?php
						$sql="SELECT DISTINCT(User.Name) as name  FROM TA, Admin_Matching, User WHERE Admin_Matching.TA_Id=TA.TA_Id and TA.User_Id=User.User_Id and TA.IsActive=1 and Admin_Matching.IsActive=1";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name'];}

					?>

					</div>
	


				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<center><h4>Courses Sections Allocated</h4><center>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="font:#FFF;">
						<br><b>Algorithm</b><br><br><a class="btn btn-success">
					<?php
						$sql="SELECT count(DISTINCT Course_Section.Lecture_Code) as total FROM Course_Section, Matching WHERE Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=1";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
						$lec=$data['total'];
						$sql="SELECT count(DISTINCT Course_Section.Lab_Code) as total FROM Course_Section, Matching WHERE Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=0";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
						$lab=$data['total'];
						echo $lec+$lab;

					?>
						</a><br>
					<?php
						$sql="SELECT Course_Section.Section_Id as sec,Course.Course_Code as name,Course_Section.Lecture_Code as lec  FROM Course,Course_Section, Matching WHERE Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=1 AND Course.Course_Id=Course_Section.Course_Id AND Course_Section.IsLecture=1 ORDER BY Course.Course_Code";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name']."  ".$data2['lec'];
							array_push($sections,$data2['sec']);
						}
						$sql="SELECT Course_Section.Section_Id as sec,Course.Course_Code as name,Course_Section.Lecture_Code as lec,Course_Section.Lab_Code as lab  FROM Course,Course_Section, Matching WHERE Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=0 AND Course.Course_Id=Course_Section.Course_Id ORDER BY Course.Course_Code";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name']."  ".$data2['lec']."  ".$data2['lab'];  
							array_push($sections,$data2['sec']);
						}


					?>

					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="font:#FFF;">
						<br><b>Admin</b><br><br><a class="btn btn-success">
					<?php
						$sql="SELECT count(DISTINCT Course_Section.Lecture_Code) as total FROM Course_Section, Admin_Matching WHERE Admin_Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=1";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
						$lec=$data['total'];
						$sql="SELECT count(DISTINCT Course_Section.Lab_Code) as total FROM Course_Section, Admin_Matching WHERE Admin_Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=0";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
						$lab=$data['total'];
						echo $lec+$lab;

					?>
						</a><br>
					<?php
						$sql="SELECT Course_Section.Section_Id as sec, Course.Course_Code as name,Course_Section.Lecture_Code as lec  FROM Course,Course_Section, Admin_Matching WHERE Admin_Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=1 AND Course.Course_Id=Course_Section.Course_Id AND Course_Section.IsLecture=1 ORDER BY Course.Course_Code";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name']."  ".$data2['lec']; 
							array_push($sections,$data2['sec']);
						}
						$sql="SELECT Course_Section.Section_Id as sec, Course.Course_Code as name,Course_Section.Lecture_Code as lec,Course_Section.Lab_Code as lab  FROM Course,Course_Section, Admin_Matching WHERE Admin_Matching.Section_Id=Course_Section.Section_Id AND Course_Section.IsLecture=0 AND Course.Course_Id=Course_Section.Course_Id ORDER BY Course.Course_Code";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name']."  ".$data2['lec']."  ".$data2['lab'];
							array_push($sections,$data2['sec']);
						}


					?>  
					</div>
				</div>						
			</div>
		<br><br>
		<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<center><h4>Users Not Matched</h4><center>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font:#FFF;">
					<br><br>	<a class="btn btn-danger">
					<?php
						$sql="SELECT count(TA.TA_Id) as total FROM TA,User WHERE TA.IsActive=1 AND TA.User_Id=User.User_Id and TA.IsActive=1";
						$result=mysqli_query($conn,$sql);
						$data=mysqli_fetch_assoc($result);
						echo $data['total']-$total_ta;

					?>
						</a><br>
					<?php
						$sql="SELECT User.Name as name FROM User,TA WHERE TA.IsActive=1 AND User.User_Id=TA.User_Id AND TA.TA_Id NOT IN (SELECT DISTINCT Matching.TA_Id From Matching where IsActive=1) AND TA.TA_Id NOT IN (SELECT DISTINCT Admin_Matching.TA_Id FROM Admin_Matching where IsActive=1)";
						$result=mysqli_query($conn,$sql);
						while($data2=mysqli_fetch_assoc($result))
						{	echo "<br>";echo $data2['name'];}
						echo "<br><br><br><br>";
					?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<center><h4>Sections Not Matched</h4><center>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font:#FFF;">
				<?php
					
						$sql1="SELECT Section_Id as sec FROM Course_Section GROUP BY Lecture_Code HAVING count(*)=1";
						$result1=mysqli_query($conn,$sql1);
						$row1=mysqli_fetch_array($result1);
							
				//			echo $row1['sec']."<br>";
						
						//choose labs
						$sql="SELECT * FROM Course_Section WHERE Course_Section.IsActive=1 AND IsLecture=0";
						$result=mysqli_query($conn,$sql);
					
						$sql2="SELECT * FROM Course_Section WHERE Course_Section.IsActive=1 AND IsLecture=1";
						$result2=mysqli_query($conn,$sql2);
						$total_count=0;
						$strLabs="";
						$strLecs="";
						//add lectures with no labs and haven't been assigned a ta
						while($row2=mysqli_fetch_array($result2))
						{
							$s=$row2['Section_Id'];
							//echo $s."<br>";
							//echo "<br>";
							if(!in_array($row2['Section_Id'], $sections) and in_array($s,$row1))
							{
								$total_count+=1;
								echo $s." HI<br>";
								$sql="SELECT Course.Course_Code as code, Course_Section.Lab_Code as lab, Course_Section.Lecture_Code as lec FROM Course,Course_Section WHERE Course.Course_Id=Course_Section.Course_Id AND Course_Section.Section_Id='$s'";
								$result1=mysqli_query($conn,$sql);
								$data2=mysqli_fetch_assoc($result1);
								$strLabs=$strLabs."<br>".$data2['code']." Lecture: ".$data2['lec']." Lab: ".$data2['lab'];
							
							}
						}
						while($data1=mysqli_fetch_assoc($result))
						{	$s=$data1['Section_Id'];
							$l=$data1['Lecture_Code'];
							//echo $l."<br><br>";
							if(!in_array($s, $sections) or in_array($s,$row1))
						{
								$total_count+=1;
								$sql="SELECT Course.Course_Code as code, Course_Section.Lab_Code as lab, Course_Section.Lecture_Code as lec FROM Course,Course_Section WHERE Course.Course_Id=Course_Section.Course_Id AND Course_Section.Section_Id='$s'";
								$result1=mysqli_query($conn,$sql);
								$data2=mysqli_fetch_assoc($result1);
								$strLecs=$strLecs."<br>".$data2['code']." Lecture: ".$data2['lec']." Lab: ".$data2['lab'];
							}
						}
						
					?>
						<br><br><a class="btn btn-danger"><?php echo $total_count;?>
						</a><br>
						<?php
							echo $strLecs.$strLabs;
							echo "<br><br><br><br>";
					?>	
					</div>
				</div>
								
			</div>

		
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	</body>
</html>			
