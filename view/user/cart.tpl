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
									<span class="prixtotal">Price with VAT</span>
									<span class="action">Actions</span>
								</div>
								<?php
									if (isset($_SESSION['panier'])) {
										$req_ids = array_keys($_SESSION['panier']);
										$produits = $DB->query('SELECT * FROM produits WHERE id IN (' . implode(',', $req_ids) . ')');
								foreach ($produits as $produit):
								?>
								<div class="row">
									<a href="#" class="img"><img src="" alt=""></a>
									<span class="name"><?php echo $produit->nom_produit; ?></span>
									<span class="prix"><?php echo number_format($produit->prix, 2, ',', ''); ?></span>
									<span class="quantité">Quantity</span>
									<span class="prixtva"><?php echo number_format($produit->prix * 1.18, 2, ',', ''); ?></span>
									<span class="action"><a href="#" class="del"><img src="" alt=""></a></span>
								</div>
								<?php endforeach; ?>
								<?php } else { ?>
								<div class="row">
									<p>The cart is empty.</p>
								</div>
								<?php } ?>

								<div class="row grey">
									<a href="#" class="img"><img src="" alt=""></a>
									<span class="name">Product Name</span>
									<span class="prix">Price</span>
									<span class="quantité">Quantity</span>
									<span class="prixtotal">Total Price</span>
									<span class="action"><a href="#" class="del"><img src="" alt=""></a></span>
								</div>
								<div class="rowtotal">
									Grand total: <span class="total">0€</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
