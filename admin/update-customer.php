<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Customer</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Customer
            $cust_id=$_GET['cust_id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_customer WHERE cust_id=$cust_id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $cust_email = $row['cust_email'];
                    $cust_username = $row['cust_username'];
                    $cust_address = $row['cust_address'];
                }
                else
                {
                    //Redirect to Manage Customer Page
                    header('location:'.SITEURL.'admin/manage-customer.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="cust_email" value="<?php echo $cust_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="cust_username" value="<?php echo $cust_username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <input type="text" name="cust_address" value="<?php echo $cust_address; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                        <input type="submit" name="submit" value="Update Customer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>


<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $cust_id = $_POST['cust_id'];
        $full_name = $_POST['full_name'];
        $cust_email = $_POST['cust_email'];
        $cust_username = $_POST['cust_username'];
        $cust_address = $_POST['cust_address'];

        //Create a SQL Query to Update Customer
        $sql = "UPDATE tbl_customer SET
        full_name = '$full_name',
        cust_email = '$cust_email', 
        cust_username = '$cust_username', 
        cust_address = '$cust_address'
        WHERE cust_id='$cust_id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Customer Updated
            $_SESSION['update'] = "<div class='success'>Customer Updated Successfully.</div>";
            //Redirect to Manage Customer Page
            header('location:'.SITEURL.'admin/manage-customer.php');
        }
        else
        {
            //Failed to Update Customer
            $_SESSION['update'] = "<div class='error'>Failed to Delete Customer.</div>";
            //Redirect to Manage Customer Page
            header('location:'.SITEURL.'admin/manage-customer.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>