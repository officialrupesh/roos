<?php include('partials/menu.php'); ?>
	
	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Food</h1>
			<br><br>

			<?php 
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];	
					unset($_SESSION['add']);	
				}
			?>

			<br><br>

			<!-- Button to add Food -->
			<a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

			<br><br><br>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>					
				</tr>

				<?php
					//create sql query to get all food data
					$sql = "SELECT * FROM tbl_food";

					//execute the query
					$res = mysqli_query($conn,$sql);

					//count rows to check whether we have foods or not
					$count = mysqli_num_rows($res);
					//create serial variable and set 1
					$sn = 1;

					if($count>0)
					{
						//we have food in Database
						//Get the foods from database and display
						while($row=mysqli_fetch_assoc($res))
						{
							//get the values from individual columns
							$food_id = $row['food_id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured =	$row['featured'];
							$active = $row['active'];
							?>

							<tr>
								<td><?php echo $sn++ ?></td>
								<td><?php echo $title; ?></td>
								<td><?php echo $price; ?></td>
								<td>
									<?php 
										//check whether we have image or not
										if($image_name=="")
										{
											//we donot have image, and display error message
											echo "<div class='error'>Image not added</div>";
										}
										else
										{
											// we have image , display image
											?>
											<img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width="100px">
											<?php
										}
									?>
								</td>
								<td><?php echo $featured; ?></td>
								<td><?php echo $active; ?></td>
								<td>
									<a href="<?php echo SITEURL?>admin/update-food.php?food_id=<?php echo $food_id?>" class="btn-secondary">Update Food</a>
									<a href="<?php echo SITEURL?>admin/delete-food.php?food_id=<?php echo $food_id?>" class="btn-danger">Delete Food</a>
								</td>
							</tr>
							<?php
						}

					}
					else
					{
						//Food not addedin database
						echo "<tr><td colspan='7' class='error'>Food not Added yet.</td></tr>";
					}

				?>

				
			
			</table>



		</div>
	</div>

	<!-- Main content section ends -->




<?php include('partials/footer.php'); ?>
	