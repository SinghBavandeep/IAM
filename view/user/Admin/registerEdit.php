<?php
    session_start();
    include('includes/header.php');
    include('includes/navbar.php');
?>
<?php







?>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Edit Admin Profile</h5>
        </div>
        <div class="card-body">
            <?php
            $connection= mysqli_connect("localhost","root","","project");
                if (isset($_POST['edit_btn'])){
                    $id= $_POST['edit_id'];
                    $query="SELECT * FROM admin WHERE id='$id'";
                    $query_run= mysqli_query($connection,$query);
                }
                foreach ($query_run as $row){
                    ?>
                    <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']?>" name="edit_username"">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" value="<?php echo $row['nom'];?>" name="edit_username" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label> Pseudo </label>
                            <input type="text" value="<?php echo $row['pseudo'];?>" name="edit_pseudo" class="form-control" placeholder="Enter Pseudo">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="<?php echo $row['email'];?>" name="edit_email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="<?php echo $row['mdp'];?>"  name="edit_password" class="form-control" placeholder="Enter Password">
                        </div>
                        <a href="registerAdmin.php" class="btn btn-danger"> CANCEL</a>
                        <button type="submit" name="update_Admin_btn" class="btn btn-success"> Update</button>
                    </form>
                    <?php
                }
            ?>

        </div>
    </div>

</div>

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>
