<?php include('partials/menu.php');?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<?php
			 if(isset($_SESSION['upload']))
			 {
			 	echo $_SESSION['upload'];
			 	unset($_SESSION['upload']);
			 }
			?>

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">

				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Title of the food">
					</td>
				</tr>

				<tr>
					<td>Description:</td>
					<td>
						<textarea name="description" cols="20" rows="5" placeholder="Description of the Food."></textarea>
					</td>
				</tr>

				<tr>
					<td>Price:</td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Select Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category:</td>
					<td>
						<select name="category">

							<?php
								//Create php code to get categories from database
								//1. Create SQL to get all active categories from database
								$sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
								
								//executing the query
								$res  = mysqli_query($conn, $sql);

								//count rows to check whether we have categories or not
								$count = mysqli_num_rows($res);

								//if count is greater than 0, we have categories else not
								if($count>0)
								{
									//we have categories
									while($row=mysqli_fetch_assoc($res))
									{
										//Get the details of category 
										$cat_id = $row['cat_id'];
										$title = $row['title'];

										?>

										<option value="<?php echo $cat_id; ?>"><?php echo $title; ?></option>

										<?php

									}
								}
								else
								{
									//We donot have categories
									?>
									<option value="0">No Category Found</option>
									<?php							
								}


								//2. Display on dropdown
							?>

						</select>
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
						<input type="radio" name="Active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>

		<?php 
		//Check whether the button is clicked or not
		if(isset($_POST['submit']))
		{
			//echo "clicked";
			
			//1. Get the data from form
			$title = $_POST['title'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$category = $_POST['category'];
			//Whether radio button for featured or active is checked or not
			if(isset($_POST['featured']))
			{
				$featured = $_POST['featured'];
			}
			else
			{
				$featured = 'No'; //setting the default value

			}
			if(isset($_POST['active']))
			{
				$active = $_POST['active'];
			}
			else
			{
				$active = 'No'; //default value
			}

			//2. Upload the image if selected
			//Check whether the select image button is clicked or not and upload image if only selected

			if(isset($_FILES['image']['name']))
			{
				//Get the details of the selected image
				$image_name = $_FILES['image']['name'];

				//check whether the image is selected or not  and upload only if selected
				if($image_name!="")
				{
					//image is selected
					//A. Rename the image
					//Get the extension of selected image type
					$ext = end(explode('.',$image_name));

					//Create new name for image
					$image_name = "Food-Name-".rand(0000,9999).".".$ext; //New image name like "Food-Name-231.jpg"
					
					//B. Upload the image
					//Get the source path and destination path

					//Source path is current image location 
					$src = $_FILES['image']['tmp_name'];

					//Destination path is destination of image
					$dst = "../images/food/".$image_name;

					//Upload image food image
					$upload = move_uploaded_file($src,$dst);

					//check image uploaded or not
					if($upload==false)
					{
						//upload failed
						//redirect to add food paege with error message
						$_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
						header('location:'.SITEURL."admin/add-food.php");

						//stop the process
						die();
					}
				}
				else
				{
					$image_name =""; //image is not selected
				}
			}
			else
			{
				//set default value as blank
				$image_name	 = "";
			}


			//3. Insert into Database


			//Create a SQL query to add food
			$sql2 = "INSERT INTO tbl_food SET
			title = '$title',
			description = '$description',
			price = $price,
			image_name = '$image_name',
			cat_id = $cat_id,
			featured ='$featured',
			active ='$active'
			 ";

			//Execute the query
			 $res2 = mysqli_query($conn,$sql2);
			 //check whether data is inserted or not
			 if(res2==true)
			 {
			 	//Data inserted successfully
			 	$_SESSION['add'] = "<div class='success'>Food Added Successfuly</div>";
			 	header('location:'.SITEURL."admin/manage-food.php");
			 }
			 else
			 	//failed to insert data
			 {
			 	$_SESSION['add'] = "<div clas='error'>Failed to add Food</div>";
			 	header('location:'.SITEURL."admin/manage-food.php");

			 }

			//4. Redirect with message to manage food page
		}

		?>


	</div>
</div>

<?php include('partials/footer.php');?>