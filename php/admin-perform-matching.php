<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Admin Dashboard</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link  type="text/javascript"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
		<link href="../css/admin.css" type="text/css" rel="stylesheet">
		<link href="../js/admin.js" type="text/javascript">
		<script src="../js/jquery-cookie-master/src/jquery.cookie.js"></script>
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
		<li><a href="#">Home</a></li>
		<li><a href="../html/admin-users.html">Users</a></li>
		<li><a href="../html/admin-courses.html">Courses</a></li> 
		<li class="active"><a href="../html/admin-matching.html">Matching</a></li> 
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
		<li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		
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
				  <li class="active">Perform Matching</li>
				</ol>
			</div>
			<!--<div class="row">-->
			<div class="row">
				<div class="container col-lg-6 col-md-6 col-xs-6 col-sm-6">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 box">
						<center><a style="color: #FFFFFF; text-decoration:none;" href="admin-deactivate-previous-matching.php?matching=admin">Deactivate Previous Admin Matching</a></center>
					</div>
				</div>
				<div class="container col-lg-6 col-md-6 col-xs-6 col-sm-6">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 box">
						<center><a style="color: #FFFFFF; text-decoration:none;" href="admin-activate-previous-matching.php?matching=admin">Activate Previous Admin Matching</a></center>
					</div>
				</div>
				
			</div>
			<br>
			<div class="row">
				<div class="container col-lg-6 col-md-6 col-xs-6 col-sm-6">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 box">
						<center><a style="color: #FFFFFF; text-decoration:none;" href="admin-deactivate-previous-matching.php?matching=algorithm">Deactivate Previous Algorithm Matching</a></center>
					</div>
				</div>
				<div class="container col-lg-6 col-md-6 col-xs-6 col-sm-6">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 box">
						<center><a style="color: #FFFFFF; text-decoration:none;" href="admin-activate-previous-matching.php?matching=algorithm">Activate Previous Algorithm Matching</a></center>
					</div>
				</div>
				
			</div>
			<br><br>
			<div class="row">
			
				<div class="container col-lg-6 col-md-6 col-xs-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 box">
						<center><a style="color: #FFFFFF; text-decoration:none;" href="admin-run-matching.php">Run Matching</a></center>
					</div>
				</div>
			
			</div>
			
		</div>
	</div>
	</body>
</html>
