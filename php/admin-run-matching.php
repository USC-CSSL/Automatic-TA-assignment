<?php
	//exec("java ../java/generateAssignment/ta/course/assignmentgenerateAssignment/ta/course/assignment/GenerateAssignment", $output);
	echo exec("java -cp ../java/mysql-connector-java-5.0.8-bin.jar:mybatis-3.4.1.jar:generateAssignment.jar ta.course.assignment.GenerateAssignment",$output);
	#echo exec("python3 file1.py",$output);
	//echo exec("python3 ./file1.py",$output);
	#echo exec("java file",$output);
	#exec('java -cp .:../java/file 2>&1', $output);
	//print_r($output);
	#echo count($output);
	echo "<script> alert('Matching Table Populated');</script>";
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin-view-matching.php">';
?>
