<?php

$connection= mysqli_connect("localhost","root","","project");

//Add Admin profile
if (isset($_POST['registeradminbtn'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $query = "INSERT INTO admin (name,username,email,password) VALUES ('$name','$username','$email','$password')";
    $query_run = mysqli_query($connection, $query);
if ($password==$cpassword) {
    if ($query_run) {
        // echo "Saved";
        $_SESSION['success'] = "Admin Profile Added";
        header('Location: registerAdmin.php');
    } else {
        $_SESSION['status'] = "Admin Profile Not Added";
        header('Location: registerAdmin.php');
    }
}else{
    $_SESSION['status']="Password and confirmation password dos not mache";
    header('Location: registerAdmin.php');
}

}

//Add Seller profile
if (isset($_POST['registersellerbtn'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $query = "INSERT INTO seller (name,username,email,password) VALUES ('$name','$username','$email','$password')";
    $query_run = mysqli_query($connection, $query);
    if ($password==$cpassword) {
        if ($query_run) {
            // echo "Saved";
            $_SESSION['success'] = "Seller Profile Added";
            header('Location: registerSeller.php');
        } else {
            $_SESSION['status'] = "Seller Profile Not Added";
            header('Location: registerSeller.php');
        }
    }else{
        $_SESSION['status']="Password and confirmation password dos not mache";
        header('Location: registerSeller.php');
    }

}

// Update Admin profile
if (isset($_POST['update_Admin_btn'])){
    $id=$_POST['edit_id'];
    $name=$_POST['edit_username'];
    $username = $_POST['edit_pseudo'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query="UPDATE admin SET name='$name',username='username',email='$email', password='$password' where id='$id'";
    $query_run=mysqli_query($connection,$query);

    if ($query_run){
        $_SESSION['success']= "Your data is update";
        header('location:registerAdmin.php');
    }else{
        $_SESSION['status']= "Your data has not update";
        header('location:registerAdmin.php');
    }
}

// Update Seller profile
if (isset($_POST['update_Seller_btn'])){
    $id=$_POST['edit_id'];
    $name=$_POST['edit_username'];
    $username = $_POST['edit_pseudo'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query="UPDATE seller SET name='$name',username='username',email='$email', password='$password' where id='$id'";
    $query_run=mysqli_query($connection,$query);

    if ($query_run){
        session_start();
        $_SESSION['success']= "Your data is update";
        header('location:registerSeller.php');
        exit();
    }else{
        session_start();
        $_SESSION['status']= "Your data has not update";
        header('location:registerSeller.php');
        exit();
    }
}

// Delete Admin profile
if (isset($_POST['delete_admin_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `admin` WHERE `admin`.`id` ='$id'";

    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success']= "Your data is DELETE";
        header('location:registerAdmin.php');
    }else{
        $_SESSION['status']= "Your data has not DELETE";
        header('location:registerAdmin.php');
    }
}

// Delete Seller profile
if (isset($_POST['delete_seller_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `seller` WHERE `seller`.`id` ='$id'";

    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success']= "Your data is DELETE";
        header('location:registerSeller.php');
    }else{
        $_SESSION['status']= "Your data has not DELETE";
        header('location:registerSeller.php');
    }
}

// Delete Seller profile
if (isset($_POST['delete_user_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `customer` WHERE `customer`.`id` ='$id'";

    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success']= "Your data is DELETE";
        header('location:registerUser.php');
    }else{
        $_SESSION['status']= "Your data has not DELETE";
        header('location:registerUser.php');
    }
}
?>