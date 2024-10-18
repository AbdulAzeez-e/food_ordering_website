<?php

    include("../config/constants.php");

    if(isset($_GET['id']) && isset($_GET['image_name'])){

        //Process to delete
        //echo "Process to delete";

        //1. Get id and image name
        $id= $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if Available
            //Check whether the image is available or not, and delete only if available
            if($image_name != ""){

                //It has image and need to be removed from folder
                //Get the image path
                $path= "../images/food/".$image_name;

                //Remove image file from folder
                $remove= unlink($path);

                //check whether the image is removed or not
                if($remove==FALSE){
                    //Failed to remove image
                    $_SESSION['upload'] = "<div class='error'>Failed To Remove Image File.</div>";
                    
                    //Redirect to Manage Food page
                    header('location:'.SITEURL.'admin/manage-food.php');

                    //stop the process of deleting food
                    die();
                }
            }
        //3. Delete food from database and Redirect to Manage Food page with Session message
            $sql= "DELETE FROM tbl_food WHERE id=$id";

            // Execute the query
            $res= mysqli_query($conn, $sql);

            //check whether the query executed or not and set the session message respectively
            if($res==TRUE){

                // Food deleted
                $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }else{

                //Failed to delete food
                $_SESSION['delete'] = "<div class='error'>Failed To Delete Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        
    }else{

        //Redirect to Manage Food Page
        // echo "Redirect to Manage Food Page";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorised Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
        
?>
        