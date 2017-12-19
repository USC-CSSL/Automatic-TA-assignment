<?php
	include('dbConnect.php');
	session_start();
	
	$username=$_SESSION['Username'];
	$sql1="SELECT * FROM `User` WHERE `Username`='$username'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_array($result1);
	$userId=$row1['User_Id'];
        //echo $userId;
	//echo $row1['Username'];	
	$sql2="SELECT * FROM `TA` WHERE `User_Id`='$userId'";
	$result2=mysqli_query($conn,$sql2);
	$row2=mysqli_fetch_array($result2);
	$taId=$row2['TA_Id'];
	//echo "TAID:".$taId;	
	//$release=0;
	$flagEmpty=0;
	if($taId==0 or $taId=="")
	{
		$flagEmpty=1;
	}
	/*
	if(isset($_SESSION['Release_Matching']))
	{
		$release=1;
		$sql3="SELECT * FROM `Matching` WHERE `TA_Id`='$taId'";
		$result3=mysqli_query($conn,$sql3);
		
		$sql4="SELECT * FROM `Admin_Matching` WHERE `TA_Id`='$taId'";
		$result4=mysqli_query($conn,$sql4);
	}
	*/

	if($flagEmpty==0)
	{
		//echo $taId;
		$sql3="SELECT * FROM `TA_Time_Constraints` WHERE `TA_Id`='$taId'";
		$result3=mysqli_query($conn,$sql3);
		//$row3=mysqli_fetch_array($result3);
		//$c1=count($row3);
		//$c=$row3['Constraint_Id'];
		//echo "ID:".$c;
		$c1=mysqli_num_rows($result3);
		//echo "Count2=".$c1;
	}
	else
	{
		$c1=0;
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
		<li class="active"><a href="../html/user-personal.html">Background</a></li>
		<li><a href="../html/user-courses.html">Courses</a></li> 
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
				  <li><a href="../html/user-personal.html">Background</a></li> 
				  <li class="active">View Time Constraints</li>
				</ol>
			</div>
		
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<center><h3>Constraints</h3><center><br>
				<?php
					if($c1!=0 and $flagEmpty!=1)
					{
				?>
				<table class="table" style="width:60%;">
				    <tbody>
					<tr>
				   	<th><center>Time Constraint</center></th>
					<th><center>Day</center></th>
					<th><center>Reason</center></th>
					<th><center>Update</center></th>
					<th><center>Delete</center></th> 
					</tr>
				   <?php
					$flag=0;
					//$result3=mysqli_query($conn,$sql3);
					
				    	//while($row3=mysqli_fetch_array($result3))
					//echo "YESS";
					while($row3=mysqli_fetch_array($result3))
				    	{	//echo "YES";
						
				    		$rId=$row3['Reason_Id'];
				    		//echo "Reason ID:".$rId;
						$sql4="SELECT * FROM `Reason` WHERE `Reason_Id`='$rId'";
						$result4=mysqli_query($conn,$sql4);
						$row4=mysqli_fetch_array($result4);
				    		$tId=$row3['Time_Interval_Not_Available_Id'];
				    		
				    		$sql6="SELECT * FROM `Time_Intervals` WHERE `Time_Slot_Id`='$tId'";
				    		$result6=mysqli_query($conn,$sql6);
				    		$row6=mysqli_fetch_array($result6);
				  		 
					 ?>
				    
					
					<tr>
					 
					    <td><center><?php echo $row6['Start_Time']." - ".$row6['End_Time'];?></center></td>
					    <td><center><?php echo $row6['Day'];?></center></td>
					    <td><center><?php echo $row4['Reason'];?><br><?php echo $row3['Reason_If_Other'];?></center></td>
				    	    <td><center><a class="btn btn-primary"  href="user-update-time-constraint.php?constraint_id=<?php echo $row3['Constraint_Id'];?>">Update</a></center></td>
					    <td><center><a class='btn btn-warning' type='submit' id='delete' name='submit' href='javascript:void(0);' onclick='confirmDelete(<?php echo $row3['Constraint_Id'];?>);'>Delete</a></center></td>
					</tr>
					<?php
					}
					//echo "YESSS";
					?>	
				    </tbody>
				</table>
				<br><br><br>
				<?php
					}
					else
					{
				?>
				
			
			<h4><center>No Time Constraints submitted.</center></h4.
			<?php
			}
			?>
			</div>
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 2%;">
				
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	function confirmDelete(constraintId)
	{
		console.log("Inside");
		if (confirm('Are you sure you want to delete this Time Constraint?')) {
		//alert(matchId);
		//alert(source);
		    //Make ajax call
		    $.ajax({
		        url: "user-delete-time-constraint.php",
		        type: "POST",
		        data: {constraint_id : constraintId},
		        dataType: "html", 
		        success: function(data) {
		            //alert("Succesfully deleted course!");
		            console.log("Success ");
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
