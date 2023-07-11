
<!-- ACCOUNT -->
<section class="account container" id="account">
	<br><br><br>
	<h2 class="section__title">All User Information</h2>
	<div class="login__form">
		<form action="" method="post" class="login__create" id="login-in">
			<h3 class="login__title">Add Admin</h3>
			<div class="login__box">
				<i class="bx bxs-user login__icon"></i>
				<input type="text" name="name" class="login__input" placeholder="Name">
			</div>
			<div class="login__box">
				<i class="bx bxs-user login__icon"></i>
				<input type="text" name="username" class="login__input" placeholder="Enter Username">
			</div>
			<div class="login__box">
				<i class="bx bx-at login__icon"></i>
				<input type="email" name="email" class="login__input" placeholder="Enter Email">
			</div>
			<div class="login__box">
				<i class="bx bxs-lock login__icon"></i>
				<input type="password" name="password" class="login__input" placeholder="Enter Password">
			</div>
			<div class="login__box">
				<i class="bx bxs-lock login__icon"></i>
				<input type="password" name="confirmpassword" class="login__input" placeholder="Confirm Password">
			</div>
			<div class="login__box">
				<i class='bx bxs-business login__icon' ></i>
				<input type="text" name="adresse" value="<?php echo isset($_SESSION['profile']) ? $_SESSION['profile']['id'] : ''; ?>" placeholder="Address" class="login__input">
			</div>
			<div class="login__box">
				<label for="profile_img">Profile Picture:</label>
				<input type="file" name="profile_img" id="profile_img" required >
			</div>
			<div class="nav container">
				<!-- RESET -->
				<input type="reset" value="Reset" class="button login__box"></input>
				<!-- Add -->
				<input type="submit" value="Add   " class="button login__box"></input>
			</div>
		</form>
	</div><br>

	<!-- View all admin-->
	<div class="login__form">
		<div class="login__create">
			<h3 class="login__title">All Admin</h3>
			<div class="container-fluid">
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
            $query="SELECT * FROM admin";
            $query_run= mysqli_query($connection, $query);

        ?>
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
							<thead>
							<tr>
								<th style="border: 1px solid black; padding: 8px;"> ID </th>
								<th style="border: 1px solid black; padding: 8px;"> Name </th>
								<th style="border: 1px solid black; padding: 8px;">Username</th>
								<th style="border: 1px solid black; padding: 8px;">Email </th>
								<th style="border: 1px solid black; padding: 8px;">EDIT </th>
								<th style="border: 1px solid black; padding: 8px;">DELETE </th>
							</tr>
							</thead>
							<tbody>
							<?php
            if (mysqli_num_rows($query_run)>0){
							while ($row=mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['id'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['name'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['username'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['email'];?></td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="registerEdit.php" method="post">
										<input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
										<button type="submit" class="btn btn-success" name="edit_admin_btn">EDIT</button>
									</form>
								</td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="code.php" method="post">
										<input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
										<button type="submit" name="delete_admin_btn" class="btn btn-danger">DELETE</button>
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
		</div
	</div><br>

	<!-- View all Seller-->
	<div class="login__form">
		<div class="login__create">
			<h3 class="login__title">All Seller</h3>
			<div class="container-fluid">
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
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
							<thead>
							<tr>
								<th style="border: 1px solid black; padding: 8px;"> ID </th>
								<th style="border: 1px solid black; padding: 8px;"> Name </th>
								<th style="border: 1px solid black; padding: 8px;">Username</th>
								<th style="border: 1px solid black; padding: 8px;">Email </th>
								<th style="border: 1px solid black; padding: 8px;">EDIT </th>
								<th style="border: 1px solid black; padding: 8px;">DELETE </th>
							</tr>
							</thead>
							<tbody>
							<?php
            if (mysqli_num_rows($query_run)>0){
							while ($row=mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['id'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['name'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['username'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['email'];?></td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="registerEdit.php" method="post">
										<input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
										<button type="submit" class="btn btn-success" name="edit_admin_btn">EDIT</button>
									</form>
								</td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="code.php" method="post">
										<input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
										<button type="submit" name="delete_admin_btn" class="btn btn-danger">DELETE</button>
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
		</div
	</div><br>

	<!-- View all user-->
	<div class="login__form">
		<div class="login__create">
			<h3 class="login__title">All Customer</h3>
			<div class="container-fluid">
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
            $query="SELECT * FROM customer";
            $query_run= mysqli_query($connection, $query);

        ?>
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
							<thead>
							<tr>
								<th style="border: 1px solid black; padding: 8px;"> ID </th>
								<th style="border: 1px solid black; padding: 8px;"> Name </th>
								<th style="border: 1px solid black; padding: 8px;">Username</th>
								<th style="border: 1px solid black; padding: 8px;">Email </th>
								<th style="border: 1px solid black; padding: 8px;">EDIT </th>
								<th style="border: 1px solid black; padding: 8px;">DELETE </th>
							</tr>
							</thead>
							<tbody>
							<?php
            if (mysqli_num_rows($query_run)>0){
							while ($row=mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['id'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['name'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['username'];?></td>
								<td style="border: 1px solid black; padding: 8px;"><?php echo $row['email'];?></td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="registerEdit.php" method="post">
										<input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
										<button type="submit" class="btn btn-success" name="edit_admin_btn">EDIT</button>
									</form>
								</td>
								<td style="border: 1px solid black; padding: 8px;">
									<form action="code.php" method="post">
										<input type="hidden" name="delete_id" value="<?php echo $row['id'];?>">
										<button type="submit" name="delete_admin_btn" class="btn btn-danger">DELETE</button>
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
		</div
	</div><br>


</section>


<div class="swiper-pagination"></div>
</div>
</section>