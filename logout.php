<?php 
include("model/configuration.php");
unset($_SESSION["Uploadexcel"]);
unset($_SESSION["name"]);
header("Location:index.php");
?>