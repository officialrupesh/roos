<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br><br>

		<?php
			if(isset($_GET['admin_id']))
			{
				$admin_id= $_GET['admin_id'];
			}
		?>

		<form action="" method="POST">
			
			<table class="tbl-30">			
				<tr>
					<td>Current Password:</td>
					<td>
						<input type="password" name="current_password" placeholder="Current Password">
					</td>
				</tr>

				<tr>
					<td>New Password:</td>
					<td>
						<input type="password" name="new_password" placeholder="New Password">
					</td>
				</tr>

				<tr>
					<td>Confirm Password:</td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm Password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="admin_id" value="<?php echo $admin_id ?>">
						<input type="submit" name="submit" value="Change Password" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>

	</div>
</div>

<?php

	//Check whether the Submit button is clicked or not
	if(isset($_POST['submit']))
	{
	 	//1. Get the data from form
	 	$admin_id = $_POST['admin_id'];
	 	$current_password = md5($_POST['current_password']);
	 	$new_password = md5($_POST['new_password']);
	 	$confirm_password = md5($_POST['confirm_password']);

	 	//2. Check whether the user with current ID and Password exists or not
	 	$sql = "SELECT * FROM tbl_admin WHERE admin_id = $admin_id AND password = '$current_password'";
	 	
	 	//execute the query
	 	$res = mysqli_query($conn, $sql);
	 	
	 	if($res==true)
	 	{
	 		//check whether data is available or not
	 		$count = mysqli_num_rows($res);
	 	
	 		if($count==1)
	 		{
	 			//User exist and password can be changed
	 			//echo "User Found";
	 			//Check whether the new password and confirm password match or not
	 			if($new_password==$confirm_password)
	 			{
	 				//Update password
	 				$sql2 =  "UPDATE tbl_admin SET
	 					password = '$new_password'
	 					WHERE admin_id = $admin_id
	 					";

	 					//EXECUTE THE QUERY
	 					$res2 = mysqli_query($conn, $sql2);

	 					//Check whether the query is executed or not
	 					if($res2==true)
	 					{
	 						//display success message
	 						//redirect to manage admin with success message
	 						$_SESSION['change-pwd'] = "<div class='success'>Password changed successfully.</div>";
	 						// Redirect the user
	 						header('location:'.SITEURL.'admin/manage-admin.php');
	 		
	 					}
	 					else
	 					{
	 						//display error message
	 						//redirect to manage admin with error message
			 				$_SESSION['change-pwd'] = "<div class='error'>Password change unsuccessful.</div>";
			 				// Redirect the user
			 				header('location:'.SITEURL.'admin/manage-admin.php');
	 		
	 					}
	 			}
	 			else
	 			{
	 				//redirect to manage admin with error message
	 				$_SESSION['pwd-not-match'] = "<div class='error'>Password didn't match.</div>";
	 				// Redirect the user
	 				header('location:'.SITEURL.'admin/manage-admin.php');
	 			}
	 		}
	 		else
	 		{	
	 			//User does not exist Set Message and redirect
	 			$_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
	 			// Redirect the user
	 			header('location:'.SITEURL.'admin/manage-admin.php');
	 		}
	 	}
	 	//3. Check whether the new password and confirm password matches or not
	 	//4. Change Password is all above is true
		}
		
?>

<?php include('partials/footer.php')?>
