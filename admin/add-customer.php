<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Customer</h1>
        <br><br>

        <?php
         if(isset($_SESSION['add'])) //Checking whether the Session is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }

        ?>
		        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" required="">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="cust_email" placeholder="Enter Your Email" required="">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="cust_username" placeholder="Your Username" required="">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <input type="text" name="cust_address" placeholder="Enter Your Name" required="">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="cust_password" placeholder="Your Password" required="">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Customer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

      
      </div>
 </div>

<?php   include('partials/footer.php')?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
 
        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $cust_email = $_POST['cust_email'];
        $cust_username = $_POST['cust_username'];
        $cust_address = $_POST['cust_address'];
        $cust_password = md5($_POST['cust_password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_customer SET 
            full_name='$full_name',
            cust_email='$cust_email',
            cust_username='$cust_username',
            cust_address='$cust_address',
            cust_password='$cust_password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Customer Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-customer.php');
        }
        else
        {
            //FAiled to Insert Data
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Customer.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-customer.php');
        }

    }
    
?>