<section class="section card">
	<!-- TITLE -->
	<h2 class="section__title">Spare parts</h2>
	<div class="card__container container">
		<div class="swiper card-swiper">
			<br>
			<div class="swiper-wrapper">
				<!-- NEW 1 -->
				<?php
				require('./model/sparepartBD.php');
				  $_SESSION['spare_parts'] = getSparePart_BD(1, 'admin', null);

                foreach ($_SESSION['spare_parts'] as $item2) {
                    echo '
                        <div class="card__content swiper-slide" id="'.$item2['ref'].'">
				<div class="card__data card__data-img">
					<img src="./view/image/'.$item2['img'].'" alt="treat1" class="card__img">
					<h3 class="card__title">'.$item2['name'].'</h3>
					<div class="card__subtitle">'.$item2['type'].'</div>
					<div class="card__price">£'.$item2['prixM'].'</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
				<div class="card__data card__data-details">
					<div class="card__detail">
						<div class="card__pagination">
							<div class="card__subtitle">Spare parts</div>
							<div class="swiper-pagination"></div>
						</div>
						<div class="card__info">
							<!-- RENT -->
							<div class="card__subtitle">Rental Dates</div>
							<p class="card__description">Beginning : ';
								echo empty($item2['debutL'])?'Aucune':$item2['debutL'];
								echo '<br>
								Fin : ';
								echo empty($item2['finL'])?'Aucune':$item2['finL'];
								echo '
							</p>
							<!-- FEATURES -->
							<div class="card__subtitle">Features</div>
							<p class="card__description">'.$item2['caract'].'</p>
							<!-- DETAILS -->
							<div class="card__subtitle">Details</div>
							<p class="card__description">'.$item2['details'].'</p>
						</div>

					</div>';
					if (isset($_GET["param"]) && $_GET['param'] == 'vehicle-home') {
					if (!isset($_SESSION['profile']) || $_SESSION['profile']['role'] != 'admin') {
					echo '
					<div class="card__buttons">
						<a href="./index.php?controller=sparepart&action=selection_flotte&param=' . $item2['ref'] . '" class="button card__button">
							<i class="bx bx-cart-alt "></i>
						</a>
					</div>';
					}
					}
					else {
					echo '
					<div class="card__buttons">';
						if ($_SESSION['profile']['role'] == 'customer') {
						if (!empty($item2['debutL']) || !empty($item2['debutL'])) {
						echo '
						<a href="./index.php?controller=sparepart&action=deselection_flotte&param=' . $item2['ref'] . '" class="button ">
							Cancel
						</a>';
						}
						else {
						echo '
						<a href="./index.php?controller=sparepart&action=deselection_flotte&param=' . $item2['ref'] . '" class="button ">
							Deselect
						</a>';
						}
						echo '
						<a href="./index.php?controller=sparepart&action=modifier_dates&param=' . $item2['ref'] . '" class="button">
							Edit
						</a>';
						}
						if ($_SESSION['profile']['role'] == 'admin') {
						echo '
						<a href="" class="button ">
							ADD
						</a>';
						echo '
						<a href="" class="button">
							Delete
						</a>';
						echo '
						<a href="" class="button">
							Edith
						</a>';
						}
						echo '
					</div>';
					}
					echo '
				</div>
			</div>
			';
			}
			?>
		</div>
	</div>
	</div>
</section>