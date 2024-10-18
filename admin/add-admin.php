<?php include("./partials/menu.php");?>

<div class= "main-content">
    <div class= "wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);// Removing session message
            }
        ?>

        <form action= "" method= "POST">
            <table class= "tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type= "text" name= "full_name" placeholder= "Enter your name"/></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type= "text" name= "username" placeholder= "Enter your username"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type= "password" name= "password" placeholder= "Enter your password"/></td>
                </tr>
                <tr>
                    <td colspan= "2"><input type= "submit" name= "submit" value= "Add Admin" class= "btn-secondary"/></td>
                    
                </tr>
            </table>


        </form>
    </div>
</div>

<?php include("./partials/footer.php");?>

<?php
    // process the value from form and save it in the database
    
    // Check whether the submit button is clicked or not
    if(isset($_POST["submit"])){
        // Button Clicked
        // echo "Button clicked";

        //1. Get the data from form
       $full_name = $_POST["full_name"];
       $username = $_POST["username"];
       $password = md5($_POST["password"]);//Password Encryption with md5

        //2. SQL Query to save data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name= '$full_name',
            username= '$username',
            password= '$password'
        ";
        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
        //4. Check whether the (Query is executed) data is inserted or not and display appropriate message
        if ($res==TRUE){
            // Data inserted
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added successfully.</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL."admin/manage-admin.php");
        }else{
            // Failed to insert data
            // echo "Data failed to insert";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            // Redirect Page to Add Admin
            header("location:".SITEURL."admin/add-admin.php");
        }
    }

    

?>