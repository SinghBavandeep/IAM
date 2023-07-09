<?php

$connection= mysqli_connect("localhost","root","","project");

//Add Admin profile
if (isset($_POST['registeradminbtn'])) {
    $username = $_POST['username'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $query = "INSERT INTO admin (nom,pseudo,email,mdp) VALUES ('$username','$pseudo','$email','$password')";
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
    $username = $_POST['username'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $query = "INSERT INTO seller (nom,pseudo,email,mdp) VALUES ('$username','$pseudo','$email','$password')";
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
    $username=$_POST['edit_username'];
    $pseudo = $_POST['edit_pseudo'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query="UPDATE admin SET nom='$username',pseudo='$pseudo',email='$email', mdp='$password' where id='$id'";
    $query_run=mysqli_query($connection,$query);

    if ($query_run){
        $_SESSION['success']= "Your data is update";
        header('location:registerAdmin.php');
    }else{
        $_SESSION['status']= "Your data has not update";
        header('location:registerAdmin.php');
    }
}

// Delete Admin profile
if (isset($_POST['delete_btn'])){
    echo ("test");
    $id=$_POST['delete_id'];
    $query="DELETE FROM admin WHERE id='$id'";
    $query_run=mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success']= "Your data is DELETE";
        header('location:registerAdmin.php');
    }else{
        $_SESSION['status']= "Your data has not DELETE";
        header('location:registerAdmin.php');
    }
}
?>