<?php

/*
$conn = mysql_connect('localhost','root','pace88sri');
mysql_select_db('ta_project') or die('could not connect');
*/
$username='root';
$password='taproject123';
$host='127.0.0.1';
$db='ta_project';
$port=3306;


$conn = mysqli_connect($host, $username, $password, $db, $port);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
//echo "Connected successfully";
//mysqli_close($conn);

?>
