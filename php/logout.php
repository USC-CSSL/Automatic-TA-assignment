<?php
session_start();
unset($_SESSION["Username"]); 
unset($_SESSION["Name"]);
unset($_SESSION["IsAdmin"]);
session_destroy();
header("Location: ../index.html");
?>
