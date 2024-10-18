<?php

    include('../config/constants.php');

    // 1. Get the id of admin to be deleted
    echo $id = $_GET['id'];
    // 2. Create SQL query to delete admin

    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==TRUE){
        //Query executed successfully and admin deleted
        //echo "Admin deleted";
        //Create Session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully.</div>";
        //Redirect to Manage  Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        //Failed to delete admin
        //echo "Failed to delete Admin";
        //Create Session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again later.</div>";
        //Redirect to Manage  Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3. Redirect to manage admin page with message(success/error)

?>