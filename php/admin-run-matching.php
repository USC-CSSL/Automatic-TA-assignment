<?php
	//exec("java ../java/generateAssignment/ta/course/assignmentgenerateAssignment/ta/course/assignment/GenerateAssignment", $output);
	echo exec("java GenerateAssignment",$output);
	#echo exec("python3 file1.py",$output);
	//echo exec("python3 ./file1.py",$output);
	echo exec("java file",$output);
	#exec('java -cp .:../java/file 2>&1', $output);
	//print_r($output);
	#echo count($output);
?>