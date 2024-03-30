<?php
include 'header.php';
?>

<div class="container" style="font-family: 'Suisse Intl' !important;">
	<div class="py-5 text-center">
		<h2 style="font-size: 5rem;">Checkout</h2>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-4 order-md-2 mb-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="mb-3" style="font-size: 3rem;"><?php echo translate('checkout_cart_title'); ?></span>
				<span class="badge badge-primary badge-pill" style="font-size: 100%;"><?php if(isset($_SESSION['cart'])) { echo count($_SESSION['cart']); } else { echo 0; } ?></span>
			</h4>
			<ul class="list-group mb-3">
				<?php 
				$total = 0;  
				if (!empty($_SESSION["cart"])) {
					foreach ($_SESSION["cart"] as $item) { 
						$item_total = $item["item_quantity"] * $item["item_price"];
						$total += $item_total;
						?>
						<li class="list-group-item d-flex justify-content-between lh-condensed">
							<div>
								<a href="index.php?id=<?php echo $item['item_id']."&qnt=". $item['qnt_pack']; ?>" target="_blank"><h6 class="my-0" style="font-size: 18px;font-family: 'Suisse Intl';font-weight: 500;"><?php echo $item["item_name"]; ?></h6></a>
								<small class="text-muted"><?php echo substr($item["item_description"],0,45).'...'; ?></small>
								<!-- <td><?php echo $item["item_quantity"]; ?></td> -->
							</div>
							<span class="text-muted"><?php echo $item["item_price"]; ?>€</span>
							<span class="text-muted" style="position: absolute;bottom: 0;right: 4%; font-weight: bold;"><?php echo $item["item_quantity"]; ?>x</span>
						</li>
						<?php 
					}
				} else {
					echo "No items in the cart...";
				}
				?>
				<li class="list-group-item d-flex justify-content-between">
					<div>
						<h6 class="my-0" style="font-size: 18px;font-family: 'Suisse Intl';font-weight: 500;">FREE SHIPPING</h6>
					</div>
					<span class="text-muted">0.00€</span>
				</li>

				<li class="list-group-item d-flex justify-content-between">
					<span>Total (EUR)</span>
					<strong><?php echo $total; ?> €</strong>
				</li>
			</ul>
			<!--
			<div style="text-align: center;">
			    <a href="https://stripe.com/docs/security" target="_blank"><img src="/assets/img/stripe-badge-white.png" style="width: 100%;"></a>
			</div>
		-->
		</div>
		<div class="col-md-8 order-md-1">
			<h4 class="mb-3" style="font-size: 3rem;"><?php echo translate('checkout_title_1'); ?></h4>
			<form class="needs-validation" method="post" action="checkout_stripe.php" id="pagamento_final">
				<input type="hidden" name="total" value="<?php echo $total; ?>">
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="firstName"><?php echo translate('checkout_label_2'); ?></label>
						<input type="text" class="form-control cool-input" id="firstName" name="firstName" placeholder="John" value="" required>
						<div class="invalid-feedback">
							Valid first name is required.
						</div>
					</div>
					<div class="col-md-6 mb-3">
						<label for="lastName"><?php echo translate('checkout_label_3'); ?></label>
						<input type="text" class="form-control cool-input" id="lastName" name="lastName" placeholder="Doe" value="" required>
						<div class="invalid-feedback">
							Valid last name is required.
						</div>
					</div>
				</div>
				<!--
				<div class="mb-3">
					<label for="username">Username</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-size: 18px;">@</span>
						</div>
						<input type="text" class="form-control cool-input" id="username" placeholder="Username" required>
						<div class="invalid-feedback" style="width: 100%;">
							Your username is required.
						</div>
					</div>
				</div>
				-->

				<div class="mb-3">
					<label for="email"><?php echo translate('checkout_label_4'); ?></label>
					<input type="email" class="form-control cool-input" id="email" name="email" placeholder="johndoe@example.com">
					<div class="invalid-feedback">
						Please enter a valid email address for shipping updates.
					</div>
				</div>

				<div class="mb-3">
					<label for="establishment"><?php echo translate('checkout_label_6'); ?> <span class="text-muted">(<?php if ($language == 'en') { echo "Important"; } else { echo "Importante"; } ?>)</span></label>
					<input type="text" class="form-control cool-input" id="establishment" name="establishment" placeholder="Dukes Bar, London">
					<label class="text-secondary"><?php echo translate('checkout_label_info_6'); ?></label>
				</div>

				
				
				<div class="row">
					<div class="col-md-5 mb-3">
						<label for="country"><?php echo translate('checkout_label_7'); ?></label>
						<select class="custom-select d-block w-100 cool-input" id="country" name="country" required>
						    <option value="">Choose...</option>
						    <option>Austria</option>
						    <option>Belgium</option>
						    <option>Bulgaria</option>
						    <option>Croatia</option>
						    <option>Cyprus</option>
						    <option>Czechia (Czech Republic)</option>
						    <option>Denmark</option>
						    <option>Estonia</option>
						    <option>Finland</option>
						    <option>France</option>
						    <option>Germany</option>
						    <option>Greece</option>
						    <option>Hungary</option>
						    <option>Ireland</option>
						    <option>Italy</option>
						    <option>Latvia</option>
						    <option>Lithuania</option>
						    <option>Luxembourg</option>
						    <option>Malta</option>
						    <option>Netherlands</option>
						    <option>Poland</option>
						    <option selected="selected">Portugal</option>
						    <option>Romania</option>
						    <option>Slovakia</option>
						    <option>Slovenia</option>
						    <option>Spain</option>
						    <option>Sweden</option>
						</select>

						<div class="invalid-feedback">
							Please select a valid country.
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<label for="zip"><?php echo translate('checkout_label_8'); ?></label>
						<input type="text" class="form-control cool-input" id="zip" name="zip" placeholder="" required>
						<div class="invalid-feedback">
							Zip code required.
						</div>
					</div>
				</div>

				<div class="mb-3">
					<label for="address"><?php echo translate('checkout_label_5'); ?></label>
					<input type="text" class="form-control cool-input" id="address" name="address" placeholder="1234 Main St" required>
					<div class="invalid-feedback">
						Please enter your shipping address.
					</div>
				</div>


				<hr class="mb-4">

				
				<h4 class="mb-3" style="font-size: 3rem;"><?php echo translate('checkout_title_2'); ?></h4>




				    
				    <input type="hidden" name="paymentMethod" value="Credit Card">
				    <hr style="margin: 10px;">
				    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-image: none; background-color: #154cbf;"><?php echo translate('checkout_buy_button'); ?></button>
				    <hr class="mb-4" style="margin: 15px;">
				    
				    <label class="text-secondary"><?php echo translate('checkout_final_info'); ?></label>

			</form>
			<hr>
		</div>
	</div>


	<script src="https://js.stripe.com/v3/"></script>




	<?php
	include 'footer.php';
?>