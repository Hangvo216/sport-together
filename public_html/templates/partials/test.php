<?php
echo"this is test page \n <br>";
$_SESSION["b"] = 2;
session_start();
$_SESSION["a"] = 1;
print_r($_SESSION);
?>