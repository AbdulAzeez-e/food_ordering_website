<?php include("./partials/menu.php");?>

        <!--Main Content Section Starts-->
        <div class= "main-content">
            <div class= "wrapper">
                <h1>Dashboard</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>


                <div class= "col-4 text-centre coral">

                    <?php
                        //SQL query
                        $sql= "SELECT * FROM tbl_category";

                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        //count rows
                        $count = mysqli_num_rows($res);

                    ?>

                    <h1><?=$count; ?></h1>
                    <br/>
                    Categories
                </div>
                <div class= "col-4 text-centre">

                    <?php
                            //SQL query
                            $sql2= "SELECT * FROM tbl_food";

                            //Execute query
                            $res2 = mysqli_query($conn, $sql2);

                            //count rows
                            $count2 = mysqli_num_rows($res2);

                        ?>

                    <h1><?=$count2; ?></h1>
                    <br/>
                    Food
                </div>


                <div class= "col-4 text-centre green">

                    <?php
                        //SQL query
                        $sql3= "SELECT * FROM tbl_order";

                        //Execute query
                        $res3 = mysqli_query($conn, $sql3);

                        //count rows
                        $count3 = mysqli_num_rows($res3);

                    ?>

                    <h1><?=$count3; ?></h1>
                    <br/>
                    Total Orders
                </div>


                <div class= "col-4 text-centre">
                    <?php
                        //create sql query to get total revenue generated
                        //Aggregate functin in sql
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered' ";

                        //Excute query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the value
                        $row4 = mysqli_fetch_assoc($res4);

                        //Get the total revenue
                        $total_revenue = $row4['Total'];
                    ?>

                    <h1>£<?=$total_revenue; ?></h1>
                    <br/>
                    Revenue Generated
                </div>
                <div class= "clearfix"></div>
            </div>
            
        </div>
        <!--Main Content Section Ends-->

<?php include("./partials/footer.php");?>
        