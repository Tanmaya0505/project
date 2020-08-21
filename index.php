<?php
include("model/configuration.php");
//$db = new DB(DBNAME, SERVER, USERNAME, PASSWORD);
/* if($_GET['err_msg']=='1')
{
	$error_msg = "<center><font class='red_bold_text'>User name and Password Invalid!</font></center>";
} */
if(isset($_SESSION["name"])) {
	?>
	<script>
		window.location= "welcome.php";
		alert("Please logout this page");
	</script>
	<?php
}
else{
$username = "";
$email    = "";
$errors = array(); 

if (isset($_POST['reg_user'])) {
	
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  
  $file = mysqli_real_escape_string($db, $_FILES['fileToUpload']['name']);
  
	
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' or is_active=1";
  $result = mysqli_query($db,$user_check_query);
  $user = Mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  } 
  if (count($errors) == 0) {
	  
	  $file = $_FILES['fileToUpload']['name'];
	 $img_extension = explode(".",$file);
	 if(($img_extension[1] != 'xlsx'))
	 {
		 array_push($errors, "Only Excel/xlsx File xlsx");
	 }
	 else
	 {
		 $targetPath = 'uploads/' . $file;
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath);
		$password = md5($password_1);//encrypt the password before saving in the database

		$query = "INSERT INTO users (username,file, email, password) 
				  VALUES('$username','$file', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: login.php');
	 }
		
  }
}
include("view/index.html");
}
?>