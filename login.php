<?php
include("model/configuration.php");
if(isset($_SESSION["name"])) {
	?>
	<script>
		window.location= "welcome.php";
		alert("Please logout this page");
	</script>
	<?php
}
else{
$err_msg = "err_msg";
$username = "";
$errors = array(); 
if(isset($_REQUEST['btn_login']))
{
	//$username = mysqli_real_escape_string($db, $_POST['username']);
   $password_1 = mysqli_real_escape_string($db, $_POST['password']);
   $password = md5($password_1);
  
	$rs = "SELECT * FROM users where username = '".$_REQUEST['username']."' and password= '".$password."'";
	$reslt = mysqli_query($db,$rs);
	$res = mysqli_num_rows($reslt);
	$result = mysqli_fetch_assoc($reslt);
    if($res)
    {
		$_SESSION["Uploadexcel"] = $result['id'];
		$_SESSION["name"] = $result['username'];
		if(isset($_SESSION["Uploadexcel"])) {
		?>
		<script>
			document.location.href='welcome.php';
		</script>
		<?php
		}
    }
    else
    {
		array_push($errors, "User name and Password Invalid!");
        
    }
}
include("view/login.html");
}
?>