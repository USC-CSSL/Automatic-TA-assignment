<?php
include('dbConnect.php');
session_start();

if (isset($_POST['name'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['confirmpassword'])) 
{
      // username and password sent from form 
      	$name = $_POST['name'];
      	$username = $_POST['username'];
      	$password = $_POST['password'];
      	$confirmpassword = $_POST['confirmpassword']; 
      	$isAdmin=0;
      //echo $password;
      //echo $confirmpassword;
      	$sql1="SELECT * FROM `User` WHERE `Username` = $username";
	$result1=mysqli_query($conn,$sql1);
	if(!mysqli_fetch_array($result1))#username does not already exist
	{
	      if($password==$confirmpassword)
	      {
		      $hashPassword=password_hash($password, PASSWORD_BCRYPT);
		      #print("Passwords match");
		      #$sql="SELECT * FROM `User`";
		      
		      #$sql2 = "INSERT INTO `User` (`Name`,`Username`,`Password`,`IsAdmin`) VALUES ($name, $username, $hashPassword, $isAdmin)";
		      $sql2="INSERT INTO User (`Name`,`Username`,`Password`,`IsAdmin`) VALUES ('$name','$username','$hashPassword','$isAdmin')";
		      $result=mysqli_query($conn,$sql2);
		      #echo $result;
		      if($result) 
		      {
			 	#echo $result;
			 
				$_SESSION['Username'] = $username;
				$_SESSION['Name'] = $name;
				$_SESSION["IsAdmin"]= $isAdmin;
                                $_SESSION["status"] = true;	
								 
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/user.html">';
		      }
		      else 
		      {
			 $error = "Sign Up Failed";
			 echo $error;
		      }
		      
	      }
	      else
	      {
	      		echo "<script> alert('Passwords do not match');</script>";
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/signup.html">';	
	      }
	}
	else
	{	
		echo "<script> alert('Username already taken');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../html/signup.html">';
	}
      
     
}
else
{
	echo "Values not Posted";
}



?>
