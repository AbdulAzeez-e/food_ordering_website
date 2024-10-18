<?php include('./partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

            //check whether the id is set or not
            if(isset($_GET['id'])){
                //Get the id and all other details
                //echo "Getting the data";
                $id = $_GET['id'];

                //Create SQL query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the query
                $res= mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1){
                    //Get all the data
                    $row= mysqli_fetch_assoc($res);
                    $title= $row['title'];
                    $current_image= $row['image_name'];
                    $featured= $row['featured'];
                    $active= $row['active'];

                }else{
                    //Redirect to Manage Category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }else{
                //Redirect to Manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method= "POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?= $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //Display the image
                                ?>
                                <img src="<?=SITEURL;?>images/category/<?=$current_image;?>" width="150px">
                                <?php

                            }else{
                                //Display message
                                echo "<div class='error'>Image Not Added.</div>";
                            }



                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value= "<?= $current_image;?>">
                        <input type="hidden" name="id" value="<?=$id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>
        </form>
        <?php
        
        if(isset($_POST['submit'])){
            //echo "clicked";

            // 1. Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // 2. Updating new image if selected
            //check whether the image is selected or not
            if(isset($_FILES['image']['name'])){
                //Get the image details
                $image_name= $_FILES['image']['name'];

                //check whether the image is available or not
                if($image_name != ""){
                    //image Available

                    //A. Upload the new image

                    //Auto rename our image
                    // Get the extension of our image(jpg, png, gf, etc)
                    $ext = end(explode('.', $image_name));

                    //Rename the image
                    $image_name = "Food_category_".rand(000, 999).'.'.$ext; // e,g Food_Category_654.jpg


                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    // And if the image is not uploaded, then we will stop the process and redirect with error message
                    if($upload==FALSE){
                        // Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        // Redirect to Add category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                        // Stop the process
                        die();
                    }

                    //B. Remove the current image if available
                    if($current_image != ""){
                        $remove_path= "../images/category/".$current_image;
                        $remove= unlink($remove_path);

                        //check whethter the image is removed or not
                        //If failed to remove, then display message and stop process
                        if($remove==FALSE){
                            //Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();//stop the process
                        }

                    }
                    


                }else{
                    $image_name = $current_image;
                }

            }else{
                $image_name = $current_image;
            }

            // 3. Update the database
            $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
            ";
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // 4. Redirect to Manage category with message
            //check whether query executed or not
            if($res2==TRUE){
                //category updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

            }else{
                //Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }
        
        
        ?>




    </div>
</div>
<?php include('./partials/footer.php'); ?>