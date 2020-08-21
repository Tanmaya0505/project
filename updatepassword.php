<?php
include("model/configuration.php");
$errors = array(); 

if (isset($_POST['btn_update'])) {
	
  
  $password = mysqli_real_escape_string($db, $_POST['old_password']);
  $passwords = md5($password);
  $newpassword = mysqli_real_escape_string($db, $_POST['new_password']);
  
  $newpasswords = md5($newpassword);
  $c_password = mysqli_real_escape_string($db, $_POST['c_password']);  
	
  if (empty($password)) { array_push($errors, "password is required"); }
  if (empty($newpassword)) { array_push($errors, "new_password is required"); }
  if ($newpassword != $c_password) {
	array_push($errors, "New passwords Confirm password do not match");
  }

  
  $user_check_query = "SELECT * FROM users WHERE id = '$_SESSION[Uploadexcel]' AND password = '$passwords'";
  $result = mysqli_query($db,$user_check_query);
  $checkcnt = mysqli_num_rows($result);
  if ($checkcnt) {
	  
		$query= "UPDATE users SET password = '$newpasswords' WHERE id = '$_SESSION[Uploadexcel]'";			
		mysqli_query($db, $query);
		array_push($errors, "Password Update Succufully"); 
		//header('location: updatepassword.php'); 		
  }
  else
	{
		array_push($errors, "Old Password is not currect"); 
	}
}
include("view/updatepassword.html");
?>
