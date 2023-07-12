<?php
    if (!empty($msg)) {
        $url = './index.php?controller=user&action=error&param1=user&param2=inscr&arg='.$msg;
        header('Location:' . $url);
    }
?>


<section class="section login">
	<!-- TITLE -->
	<h2 class="section__title">Add_Admin</h2>
	<div class="login__container container">
		<div class="login__content">
			<div class="login__img">
				<img src="./view/image/login-img.svg" alt="login">
			</div>
			<!-- FORM -->
			<div class="login__form">
				<form action="./index.php?controller=user&action=AddnewAS" method="post" class="login__create" id="login-in">
					<h3 class="login__title">Registration</h3>
					<div class="login__box">
						<i class="bx bxs-user login__icon"></i>
						<select name="typeAS" id="typeAS">
							<option value="Admin">Admin</option>
							<option alue="Seller">Seller</option>
						</select>
					</div>

					<div class="login__box">
						<i class="bx bxs-user login__icon"></i>
						<input type="text" name="name" value="" placeholder="Name" class="login__input" required>
					</div>
					<div class="login__box">
						<i class="bx bxs-user login__icon"></i>
						<input type="text" name="username" value="" placeholder="Username" class="login__input" required>
					</div>
					<div class="login__box">
						<i class="bx bx-at login__icon"></i>
						<input type="email" name="email" value="" placeholder="EMail" class="login__input" required>
					</div>
					<div class="login__box">
						<i class="bx bxs-lock login__icon"></i>
						<input type="password" name="password" placeholder="Password" class="login__input" id="password" autocomplete="off" required>
						<i class='bx bxs-show login__togglePassword' id="toggle-password"></i>
					</div>
					<div class="login__box">
						<i class='bx bxs-business login__icon' ></i>
						<input type="text" name="address" value="" placeholder="Address" class="login__input" required>
					</div>
					<div class="login__box">
						<label for="profile_img">Profile Picture:</label>
						<input type="file" name="profile_img" id="profile_img" required >
					</div>
					<!-- SIGN IN -->
					<input type="submit" value="Register" class="button login__button"></input>

					<!-- SIGN UP -->
					<div>
						<span class="login__account">Already have an account?</span>
						<a href="./index.php?controller=user&action=ident" class="login__signup">Login</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>