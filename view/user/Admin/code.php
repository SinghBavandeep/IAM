<?php


$connection= mysqli_connect("localhost","root","","project");

if (isset($_POST['registerbtn'])) {
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
        header('Location: register.php');
    } else {
        $_SESSION['status'] = "Admin Profile Not Added";
        header('Location: register.php');
    }
}else{
    $_SESSION['status']="Password and confirmation password dos not mache";
    header('Location: register.php');
}

}

if (isset($_POST['updatebtn'])){
    $id=$_POST['edit_id'];
    $username=$_POST['edit_username'];
    $pseudo = $_POST['edit_pseudo'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query="UPDATE admin SET nom='$username',pseudo='$pseudo',email='$email', mdp='$password' where id='$id'";
    $query_run=mysqli_query($connection,$query);

    if ($query_run){
        $_SESSION['success']= "Your data is update";
        header('location:register.php');
    }else{
        $_SESSION['status']= "Your data has not update";
        header('location:register.php');
    }
}
?>