
<!-- ACCOUNT -->
<section class="account container" id="account">
	<br><br><br>
	<h2 class="section__title">All User Information</h2>
	<?php include('Menu_Admin.tpl')?><br>
	<!-- View all admin-->
	<div id="Vadmin" class="login__form">
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
	<div id="Vseller" class="login__form">
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
	<div id="Vcustomer" class="login__form">
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