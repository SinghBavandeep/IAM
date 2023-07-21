
<section class="account container" id="account">
    <br><br><br>
    <h2 class="section__title">Edit Profile</h2>
    <div class="login__form">
        <?php
        $connection= mysqli_connect("localhost","root","","project");
        if (isset($_POST['edit_admin_btn'])){
            $id= $_POST['edit_id'];
            $query="SELECT * FROM admin WHERE id='$id'";
            $query_run= mysqli_query($connection,$query);
        }
        if (isset($_POST['edit_Seller_btn'])){
            $id= $_POST['edit_id'];
            $query="SELECT * FROM seller WHERE id='$id'";
            $query_run= mysqli_query($connection,$query);
        }

        foreach ($query_run as $row){
            ?>
            <form action="./view/user/code.php" method="post" class="login__create">
                <input type="hidden" name="edit_id" value="<?php echo $row['id']?>" name="edit_username"">
                <div class="form-group">
                    <label> Usernam </label>
                    <input type="text" value="<?php echo $row['name'];?>" name="edit_username" class="form-control" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label> Pseudo </label>
                    <input type="text" value="<?php echo $row['username'];?>" name="edit_pseudo" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?php echo $row['email'];?>" name="edit_email" class="form-control" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" value="<?php echo $row['password'];?>"  name="edit_password" class="form-control" placeholder="Enter Password">
                    <input type="hidden" value="<?php if (isset($_POST['edit_admin_btn'])){echo "Admin";}else{echo "Seller";}?>"  name="type" class="form-control">
                </div>
                <a href="./index.php?controller=user&action=adminpanel" class="btn btn-danger">CANCEL</a>
                <button type="submit" name="update_btn" class="btn btn-success"> Update</button>
            </form>
            <?php
        }
        ?>

    </div>
</section>



