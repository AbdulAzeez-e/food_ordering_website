<?php include("../config/constants.php"); ?>



<html>
    <head>
        <title>Login - Food Order System </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class= "text-centre">Login</h1> <br> <br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset( $_SESSION['no-login-message'])){
                    echo  $_SESSION['no-login-message'];
                    unset( $_SESSION['no-login-message']);
                }
            ?>
            <br> <br>

            <!-- Login form starts here -->

            <form action="" method="POST" class= "text-centre">

            Username:
            <br>
            <input type="text" name="username" placeholder="Enter username">
            <br> <br>
            Password:
            <br>
            <input type="password" name= "password" placeholder="Enter password"> <br> <br>
            <input type="submit" value="Login" name="submit" class="btn-primary"> <br> <br>
            </form>

            <!-- Login form ends here -->


            <p class= "text-centre">Created by - <a href="#" >Abdulazeez Ewedairo</a></p>
        </div>
    </body>
</html>

<?php

// check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    //Process for login
    //1. Get the data from login form
     //$username= $_POST['username'];
     $username= mysqli_real_escape_string( $conn, $_POST['username']);
     $password = md5($_POST['password']);

     //2. SQL to check whether the user with username and password exit or not
     $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

     //3. Execute sql query
     $res= mysqli_query($conn, $sql);

     //4. Count rows to check whether the user exists or not
     $count= mysqli_num_rows($res);

     if($count==1){
        //User Available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful. </div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it.


        //Redirect to Home page/Dashboard
        header('location:'.SITEURL.'admin/');
     }else{
        //User not Available and login fail
        $_SESSION['login'] = "<div class='error text-centre'>Username or Password did not match. </div>";

        //Redirect to Home page/Dashboard
        header('location:'.SITEURL.'admin/login.php');
     }

}

?>
