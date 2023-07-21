<!-- CART -->

<section class="section card">
	<div class="card__container container">
		<div class="swiper card-swiper">
			<div class="container">
				<div class="checkout">
					<div class="title">
						<div class="wrap">
							<h2 class="first">Shopping Cart</h2>
						</div>
						<div class="table">
							<div class="wrap">
								<div class="rowtitle">
									<span class="name">Product Name</span>
									<span class="prix">Price</span>
									<span class="quantité">Quantity</span>
									<span class="prixtotal">Total Price</span>

									<span class="action">Actions</span>
								</div>
								<?php
								// Assuming you have the customer_id stored in a session variable like $_SESSION['id']
								$customer_id = $_SESSION['id'] ?? 0;

								if ($customer_id > 0 && isset($_SESSION['cart'])) {
								$req_ids = array_keys($_SESSION['cart']);
								$vehicle_ids = array_filter($req_ids, function($id) { return substr($id, 0, 1) === 'V'; });
								$spare_part_ids = array_filter($req_ids, function($id) { return substr($id, 0, 1) === 'S'; });

								// Fetch vehicles from the database
								if (!empty($vehicle_ids)) {
								$vehicle_ids_str = implode(',', array_map('intval', $vehicle_ids));
								$vehicles = $DB->query("SELECT * FROM vehicle WHERE ref IN ($vehicle_ids_str) AND idC = $customer_id");
								foreach ($vehicles as $vehicle):
								?>
								<div class="row">
									<a href="#" class="img"><img src="" alt=""></a>
									<span class="name"><?php echo $vehicle->name; ?></span>
									<span class="prix"><?php echo number_format($vehicle->prixM, 2, ',', ''); ?></span>
									<span class="quantité"><?php echo $_SESSION['cart']['V' . $vehicle->ref] ?? 0; ?></span>
									<span class="prixtotal"><?php echo number_format($vehicle->prixM * $_SESSION['cart']['V' . $vehicle->ref], 2, ',', ''); ?></span>
									<span class="action"><a href="#" class="del"><img src="" alt=""></a></span>
								</div>
								<?php
										endforeach;
									}

									// Fetch spare parts from the database
									if (!empty($spare_part_ids)) {
										$spare_part_ids_str = implode(',', array_map('intval', $spare_part_ids));
										$spare_parts = $DB->query("SELECT * FROM spare_part WHERE ref IN ($spare_part_ids_str) AND idC = $customer_id");
								foreach ($spare_parts as $spare_part):
								?>
								<div class="row">
									<a href="#" class="img"><img src="" alt=""></a>
									<span class="name"><?php echo $spare_part->name; ?></span>
									<span class="prix"><?php echo number_format($spare_part->prixM, 2, ',', ''); ?></span>
									<span class="quantité"><?php echo $_SESSION['cart']['S' . $spare_part->ref] ?? 0; ?></span>
									<span class="prixtotal"><?php echo number_format($spare_part->prixM * $_SESSION['cart']['S' . $spare_part->ref], 2, ',', ''); ?></span>
									<span class="action"><a href="#" class="del"><img src="" alt=""></a></span>
								</div>
								<?php
										endforeach;
									}

								} else {
								?>
								<div class="row">
									<p>The cart is empty.</p>
								</div>
								<?php } ?>

								<!-- ... other rows and total calculation ... -->

								<!-- Add the "Process payment" button -->
								<div class="row grey">
									<!-- ... other columns ... -->
									<span class="action">
       								 <a href="./index.php?controller=payment&action=process_payment" class="del">Process payment</a>
    								</span>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
