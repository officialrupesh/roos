<?php 

    //Include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of Customer to be deleted
    $cust_id = $_GET['cust_id'];

    //2. Create SQL Query to Delete customer
    $sql = "DELETE FROM tbl_customer WHERE cust_id=$cust_id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successully and Customer Deleted
        //echo "Customer Deleted";
        //Create SEssion Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Customer Deleted Successfully.</div>";
        //Redirect to Manage Customer Page
        header('location:'.SITEURL.'admin/manage-customer.php');
    }
    else
    {
        //Failed to Delete Customer
        //echo "Failed to Delete Customer";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Customer.</div> ";
        header('location:'.SITEURL.'admin/manage-customer.php');
    }

    //3. Redirect to Manage Customer page with message (success/error)

?>  