<?php
    // Include Constants file
    include("../config/constants.php");

    //echo "Delete Page";
    //Check whether the id and image_name is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //Get the value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name != ""){

            //Image is available. so remove it
            $path = "../images/category/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //If failed to remove image then add an error message and stop the process
            if($remove==FALSE){

                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";

                //Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop the process
                die();
            }
        }


        //Delete data from database
        // SQL query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the query
        $res= mysqli_query($conn, $sql);

        //Check whethter the data is deleted from database or not
        if($res==TRUE){
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');

        }else{
            //Set failed message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";

            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }else{
        //Redirect to Manage- category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }

?>