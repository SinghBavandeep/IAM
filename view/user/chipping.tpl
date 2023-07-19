<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .product {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .product img {
        max-width: 100%;
        border-radius: 5px;
    }

    .product h2 {
        margin: 0;
        padding: 0;
    }

    .product p {
        margin: 5px 0;
    }

    .cart {
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .cart h2 {
        margin: 0;
        padding: 0;
    }

    .cart-item {
        margin-bottom: 10px;
    }
</style>
<section class="account container" id="account">
	<br><br><br>
	<h2 class="section__title">Chipping Mode</h2>
	<div class="login__form">
		<div class="login__create">
			<div class="container">
				<div class="product">
					<img src="https://via.placeholder.com/200" alt="Product 1">
					<h2>Car Battery</h2>
					<p>$99.99</p>
					<button>Add to Cart</button>
				</div>

				<div class="product">
					<img src="https://via.placeholder.com/200" alt="Product 2">
					<h2>Brake Pads</h2>
					<p>$49.99</p>
					<button>Add to Cart</button>
				</div>

				<div class="product">
					<img src="https://via.placeholder.com/200" alt="Product 3">
					<h2>Oil Filter</h2>
					<p>$9.99</p>
					<button>Add to Cart</button>
				</div>

				<div class="cart">
					<h2>Shopping Cart</h2>
					<div class="cart-item">
						<span>Car Battery</span>
						<span>$99.99</span>
						<button>Remove</button>
					</div>
					<div class="cart-item">
						<span>Brake Pads</span>
						<span>$49.99</span>
						<button>Remove</button>
					</div>
					<div class="cart-item">
						<span>Oil Filter</span>
						<span>$9.99</span>
						<button>Remove</button>
					</div>
					<p>Total: $159.97</p>
					<button>Checkout</button>
				</div>
			</div>
		</div>
</section>

<div class="swiper-pagination"></div>
</div>
</section>