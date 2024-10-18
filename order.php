<?php include('./partials-front/menu.php'); ?>

    <?php
        //check whether food id is set or not
        if(isset($_GET['food_id'])){

            //Get the food id and details of the selected food
            $food_id = $_GET['food_id'];

            //Get the details of the selected food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows
            $count = mysqli_num_rows($res);
            
            //check whether data is available or not
            if($count==1){

                //We have data
                //Get the data from database
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];

            }else{

                //Food not availabe
                //Redirect to homepage
                header('location:'.SITEURL);

            }

        }else{

            //Redirect to homepage
            header('location:'.SITEURL);

        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method= "POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check whether the image is available or not
                            if($image_name==""){

                                //Image not available
                                echo "<div class='error'>Image not Available.</div>";

                            }else{

                                //Image is available
                                ?>
                                    <img src="<?=SITEURL; ?>images/food/<?=$image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?= $title; ?></h3>
                        <input type="hidden" name="food" value="<?=$title; ?>">

                        <p class="food-price">£<?= $price; ?></p>
                        <input type="hidden" name="price" value= "<?=$price; ?>" >

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                //check whether submit button is clickd or not
                if(isset($_POST['submit'])){

                    //Get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered"; // Ordered, on Delivery, Delivered, Cancelled
                    $customer_name =  $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in database
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed or not
                    if($res2==TRUE){

                        //Query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully.</div>";
                        header('location:'.SITEURL);

                    }else{

                        //Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Order Failed.</div>";
                        header('location:'.SITEURL);

                    }

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('./partials-front/footer.php'); ?>