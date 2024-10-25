<?php include('./partials-front/menu.php'); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
                //Get the search keyword
                //$search= $_POST['search'];
                $search= mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?= $search;  ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //Sql Query to get foods based on search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count= mysqli_num_rows($res);

                //check whether food is available or not
                if($count >0){

                    //Food available
                    while($row=mysqli_fetch_assoc($res)){

                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check whether image is available or not
                                        if($image_name==""){

                                            //Image not availabe
                                            echo "<div class='error'>Image not found.</div>";


                                        }else{

                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php

                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?= $title; ?></h4>
                                    <p class="food-price">£<?= $price; ?></p>
                                    <p class="food-detail">
                                        <?= $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }

                }else{

                    //Food not available
                    echo "<div class='error'>Food not found.</div>";

                }
            ?>


            <div class="clearfix"></div> 

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./partials-front/footer.php'); ?>
