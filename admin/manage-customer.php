<?php include('partials/menu.php'); ?>
	
	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Customer</h1>
			<br><br>

			<?php 
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];	
					unset($_SESSION['add']);	
				}
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];  
                    unset($_SESSION['delete']);    
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];  
                    unset($_SESSION['update']);    
                }
                
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];  
                    unset($_SESSION['user-not-found']);    
                }
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];  
                    unset($_SESSION['pwd-not-match']);    
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];  
                    unset($_SESSION['change-pwd']);    
                }

			?>
			<br><br>


			<!-- Button to add customer -->
			<a href="add-customer.php" class="btn-primary">Add Customer</a>

			<br><br><br>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Username</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
				<?php 
                        //Query to Get all customer
                        $sql = "SELECT * FROM tbl_customer";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //CHeck whether the Query is Executed of Not
                        if($res==TRUE)
                        {
                            // Count Rows to CHeck whether we have data in database or not
                            $count = mysqli_num_rows($res); // Function to get all the rows in database

                            $sn=1; //Create a Variable and Assign the value

                            //CHeck the num of rows
                            if($count>0)
                            {
                                //WE HAve data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using While loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual DAta

                                    $cust_id = $rows['cust_id'];
                                    $full_name = $rows['full_name'];
                                    $cust_email = $rows['cust_email'];
                                    $cust_username = $rows['cust_username'];
                                    $cust_address=$rows['cust_address'];
                                    

                                    //Display the Values in our Table
                ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $cust_email; ?></td>
                                        <td><?php echo $cust_username; ?></td>
                                        <td><?php echo $cust_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-cust-password.php?cust_id=<?php echo $cust_id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-customer.php?cust_id=<?php echo $cust_id; ?>" class="btn-secondary">Update Customer</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-customer.php?cust_id=<?php echo $cust_id; ?>" class="btn-danger">Delete Customer</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //We Do not Have Data in Database
                            }
                        }

                    				?>
			
			</table>
	

	




		</div>
	</div>

	<!-- Main content section ends -->




<?php include('partials/footer.php'); ?>
	