<?php
include('dbConnect.php');
session_start();
	if(isset($_POST['username'])&&isset($_POST['password'])) 
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		//$username = trim($_POST['username']);
		//$password = trim($_POST['password']);
	
		$sql="SELECT * FROM `User` WHERE `Username`= '$username'";
		$result=mysqli_query($conn,$sql);
		if(!$result)
		  {
			echo "NO RESULT";	
		  }

		$row=mysqli_fetch_array($result);
		if(count($row)!=0)
		  {
			if(!password_verify($password,$row['Password']))
			  {
				echo "<script> alert('Wrong Password'); </script>";
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.html">'; 
			  }
			else
			  {
				echo "<script> alert('Welcome $username'); </script>";
				
				#echo $row['IsAdmin'];
				
				$_SESSION["Username"]= $username;
				$_SESSION["Name"]= $row['Name'];
				$_SESSION["IsAdmin"]= $row['IsAdmin'];
				$_SESSION["status"] = true;				

				if($row['IsAdmin']==1)
				{
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/admin.html">'; 
				}
				else
				{
					echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user.html">'; 
				}
			}
		}
		else
		{
			echo "<script> alert('User does not exists. Please enter a valid Username !!!'); </script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.html">'; 	
		}
	}

	//else
	//{
	//	echo "<script> alert('Values not Posted'); </script>";
	//	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.html">'; 
	//}







/*
if(isset($_POST['username'])&&isset($_POST['password'])) 
{
      // username and password sent from form 
      
      $username = $_POST['username'];
      $password = $_POST['password']; 
      echo $username;
      echo $password;
      $sql = "SELECT * FROM User WHERE username = `$username`";
      $result = mysqli_query($conn,$sql);
      echo "calculated result";
      $row = mysqli_fetch_array($res);
      echo "fetched row";
      if (mysqli_num_rows($row) == 1) 
      {
	      echo "\n";
      	      echo $row['Name'];
	      #print($row['isAdmin']);
	      if(password_verify($password,$result['password']))//passwords match
	      {
	      		$_SESSION['username'] = $username;
	      		$_SESSION['name']=$result['name'];
		 	if($result['isAdmin']==1)
		 	{
		 		echo "HI";
		 		header("Location: ../html/admin.html");
		 	}
		 	else
		 	{	
		 		echo "Hi 1";
		 		header("Location: ../html/user.html");
		 	}
		 	
	      }else {
		 $error = "Your Login Name or Password is invalid";
		 print $error;
	      }
	}
	else
	{
	}
      
   }
else{
	echo "Values not Posted";
}
*/

?>
