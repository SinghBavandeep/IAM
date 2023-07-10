<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Seller Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label> Pseudo </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registersellerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Seller Profile
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Seller Profile
            </button>
    </h6>
  </div>

  <div class="card-body">

      <?php
        if (isset($_SESSION['success']) && $_SESSION['success'] !=""){
            echo '<h2 class="bg-primary">'.$_SESSION['success'].'</h2>';
            unset($_SESSION['success']);
        }

      if (isset($_SESSION['status']) && $_SESSION['status'] !=""){
          echo '<h2 class="bg-danger">'.$_SESSION['status'].'</h2>';
          unset($_SESSION['status']);
      }
      ?>
    <div class="table-responsive">
        <?php
            $connection= mysqli_connect("localhost","root","","project");
            $query="SELECT * FROM seller";
            $query_run= mysqli_query($connection, $query);

        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th>Name</th>
            <th>Username</th>
            <th>Email </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php
            if (mysqli_num_rows($query_run)>0){
                while ($row=mysqli_fetch_assoc($query_run)){
                    ?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td>
                            <form action="registerEdit.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                            <button type="submit" class="btn btn-success" name="edit_Seller_btn">EDIT</button>
                            </form>
                        </td>
                        <td>
                            <form action="code.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
                                <button type="submit" name="delete_seller_btn" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    <?php

                }
            }
            else{
                echo "NO Recorde Found";
            }
        ?>





        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>