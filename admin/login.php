<?php include('../config/constants.php'); ?>

<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>

	<div class="login">
		<h2 class="text-center">Admin Login</h2>
		<br><br>

		<?php 
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}

		if(isset($_SESSION['no-login-message']))
		{
			echo $_SESSION['no-login-message'];
			unset($_SESSION['no-login-message']);
		}
		?>
		<br><br>
		<!-- Login form starts here -->
		<form action="" method="POST" class="text-center">
			Username:<br>
			<input type="text" name="username" placeholder="Enter Username"><br><br>

			Password:<br>
			<input type="password" name="password" placeholder="Enter Password"><br><br>

			<input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
		</form>
		<!-- Login form ends here -->

		<p class="text-center">Created by - <a href="#">Everest Engineering College</a></p>
	</div>

</body>
</html>

<?php 
	//Check whether the submit Button is Clicked or not
	if (isset($_POST['submit'])) 
	{
		//proces for login
		//1. get the data from login form
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//2. SQL to check whether the user with username and password exist or not
		$sql = "SELECT * FROM tbl_admin where username = '$username' AND password='$password'";

		//3. execute the query
		$res = mysqli_query($conn, $sql);

		//4. count rows to check whether the user exists or not
		$count = mysqli_num_rows($res);

		if ($count==1)
		 {
			//User Available and login success
			$_SESSION['login'] = "<div class='success'>Login Successful</div>";

			$_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it.



			//Redirect to Home page 
			header('location:'.SITEURL.'admin/'); 
		}
		else
		{
			//user not available and login failed
			$_SESSION['login'] = "<div class='error text-center'>Username or Password didn't match</div>";
			//Redirect to Home page 
			header('location:'.SITEURL.'admin/login.php');

		}
	}
?>