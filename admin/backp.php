<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>
		
		<br><br>

		<?php

			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

		?>
		<br><br> 

		<!-- Add Category Form starts -->
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>

				<tr>
					<td>Select Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="No">No
					</td>
				</tr>

				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>	

		<!-- Add Category Form ends -->

		<?php

			//check whether the submit button is clicked or not
			if(isset($_POST['submit']))
			{
				//1. Get the value from Category Form
				$title = $_POST['title'];

				//For radio inputtype, we need to check whether the button is selected or not
				if(isset($_POST['featured']))
				{
					//Get the value from form
					$featured = $_POST['featured'];
				} 
				else
				{
					//Set the default value
						$featured = "No";
				}

				if(isset($_POST['active']))
				{
					$active = $_POST['active'];
				}
				else
				{
					$active ="No";
				}

				//Check whether the image is selected or not and set the value for image name accordingly
				if(isset($_FILES['image']['name']))
				{
					//upload the image
					//to upload image we need image name, source path and destination path
					$image_name = $_FILES['image']['name'];

					$source_path = $_FILES['image']['tmp_name'];
					
					$destination_path = "../images/category/".$image_name;

					//upload image 
					$upload = move_uploaded_file($source_path, $destination_path);

					//check if the image is uploaded or not
					//and if image is notuploaded then we will stop the process and redirect with error message
					if($upload==false)
					{
						//setmessage
						$_SESSION['upload'] ="<div class='error' >Failed to upload image.</div>";
						//redirect to add category page
						header('location:'.SITEURL.'admin/add-category.php');
						// stop the process
						die();
					}

				}
				else
				{
					//dont upload image and set the image name value as blank
					$image_name = "";
				}




				//2. Create SQL query to insert category into database
				$sql = "INSERT INTO tbl_category SET
				title = '$title',
				image_name = $image_name,
				featured = '$featured',
				active = '$active'

				";

				//3. Execute the Query and save in database
				$res = mysqli_query($conn, $sql);

				//4. Check whether the query executed or not and data added or not
				if($res==true)
				{
					//Query executed and category added
					$_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
					//Redirect into manage category page
					header('location:'.SITEURL.'admin/manage-category.php');

				}
				else
				{
					//Failed to add category
					$_SESSION['add'] = "<div class='error'>Failed to add Category.</div>";
					//Redirect into add category page
					header('location:'.SITEURL.'admin/add-category.php');
				}



			}
		?>



	</div>
</div>

<?php include('partials/footer.php'); ?>
