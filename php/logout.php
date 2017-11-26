<?php
session_start();
unset($_SESSION["Username"]); 
unset($_SESSION["Name"]);
unset($_SESSION["IsAdmin"]);
header("Location: ../index.html");
?>
