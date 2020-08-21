<?php
define("SERVER","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DBNAME","uplodexcel");
$project_path = "http://localhost/uplodexcel/";
$db=mysqli_connect(SERVER, USERNAME, PASSWORD,DBNAME) or die('Server connexion not possible.');
session_start();
$t = time();
?>