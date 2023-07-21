<?php

$connection= mysqli_connect("localhost","root","","project");

//Add Admin profile
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $type=$_POST['typeAS'];

    if ($type=="Admin"){
        $query = "INSERT INTO admin (name,username,email,password) VALUES ('$name','$username','$email','$password')";
    }else{
        $query = "INSERT INTO seller (name,username,email,password) VALUES ('$name','$username','$email','$password')";
    }

    $query_run = mysqli_query($connection, $query);
if ($password==$cpassword) {
    if ($query_run) {
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>window.history.back();</script>";
    }
}else{
    echo "<script>window.history.back();</script>";
}

}


// Update profile
if (isset($_POST['update_btn'])){
    $id=$_POST['edit_id'];
    $name=$_POST['edit_username'];
    $username = $_POST['edit_pseudo'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $type=$_POST['type'];

    if ($type=="Admin"){
        $query="UPDATE admin SET name='$name',username='$username',email='$email', password='$password' where id='$id'";
    }else{
        $query="UPDATE seller SET name='$name',username='$username',email='$email', password='$password' where id='$id'";
    }


    $query_run=mysqli_query($connection,$query);

    if ($query_run){
        echo "<script>window.location.href = '../../index.php?controller=user&action=adminpanel';</script>";
    }else{
        echo "<script>window.location.href = '../../index.php?controller=user&action=adminpanel';</script>";
    }
}

// Delete Admin profile
if (isset($_POST['delete_admin_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `admin` WHERE `admin`.`id` ='$id'";

    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo "<script>window.history.back();</script>";
    } else {
        echo "<script>window.history.back();</script>";
    }
}

// Delete Seller profile
if (isset($_POST['delete_seller_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `seller` WHERE `seller`.`id` ='$id'";

    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        echo "<script>window.history.back();</script>";
    }else{
        echo "<script>window.history.back();</script>";

    }
}

// Delete Seller profile
if (isset($_POST['delete_user_btn'])){
    $id=$_POST['delete_id'];

    $query="DELETE FROM `customer` WHERE `customer`.`id` ='$id'";

    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        echo "<script>window.history.back();</script>";

    }else{
        echo "<script>window.history.back();</script>";
    }
}
?>