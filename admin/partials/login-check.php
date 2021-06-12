
<?php 
    //
    //Check whether the user is logged in or not
	if (!isset($_SESSION['user'])) //if user session is not set
	 {
		//User is not logged in 
		//Redirect to login page with message 
		$_SESSION['no-login-message'] = "<div class='error'>Please login to access to admin panel</div>";
		//Redirect to login page
		header('location:'.SITEURL.'admin/login.php');
	}
?>