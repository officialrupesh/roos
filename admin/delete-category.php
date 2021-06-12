<?php
	//Include constant file
	include('../config/constants.php');
	//echo "Delete Page";
	//check whether the id and image_name is set or not
	if(isset($_GET['cat_id']) AND isset($_GET['image_name']))
	{
		//get the value and delete
		$cat_id = $_GET['cat_id'];
		$image_name = $_GET['image_name'];

		//remove the physical image file if available
		if($image_name!="")
		{
			//Image is available, so remove it
			$path = "../images/category/".$image_name;
			//Remove the image
			$remove = unlink($path);

			//if failed to remove image then add an error message and stop the process

			if($remove==false)
			{
				//set the session message
				$_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
				//redirect to mnage category page
				header('location:'.SITEURL.'admin/manage-category.php');
				//stop the proces
				die();

			}
		}

		//delete data from database
		//SQL query to delete data from database
		$sql = "DELETE FROM tbl_category WHERE cat_id = $cat_id";

		//execute the query
		$res = mysqli_query($conn,$sql);

		//check whether the data is delete from database or not
		if($res==true)
		{
			//SET success message
			$_SESSION['delete'] = "<div class='success'>Category Deleted successfully.</div>";
			//redirect to manage category
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		else
		{
			//set failed message
			$_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
			//redirect to manage category
			header('location:'.SITEURL.'admin/manage-category.php');
		}


	}
	else
	{
		//redirect to manage category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}
?>