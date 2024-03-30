<?php
include 'header.php';
$countries = ["Austria", "Belgium", "Bulgaria", "Croatia", "Cyprus", "Czechia (Czech Republic)", "Denmark", "Estonia", "Finland", "France", "Germany", "Greece", "Hungary", "Italy", "Latvia", "Lithuania", "Luxembourg", "Malta", "Netherlands", "Poland", "Portugal", "Ireland", "United States", "United Kingdom", "Romania", "Slovakia", "Slovenia", "Spain", "Sweden"];

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
							<span class="text-muted"><?php echo $item["item_price"] . $currency; ?></span>
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
						<h6 class="my-0" style="font-size: 18px;font-family: 'Suisse Intl';font-weight: 500;"><?php echo translate('shipping_checkout_info'); ?></h6>
					</div>
					<span class="text-muted">0.00<?php echo $currency; ?></span>
				</li>

				<li class="list-group-item d-flex justify-content-between">
					<span>Total (<?php echo $currency_format; ?>)</span>
					<strong><?php echo number_format($total, 2); ?> <?php echo $currency; ?></strong>
				</li>
			</ul>
			
			<div style="text-align: center;">
			    <a href="https://stripe.com/docs/security" target="_blank"><img src="/assets/img/stripe-badge-white.png" style="width: 100%;"></a>
			</div>
		
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
					    <?php
					        foreach ($countries as $country) {
					            echo '<option value="' . $country . '"' . ($user_country == $country ? ' selected="selected"' : '') . '>' . $country . '</option>';
					        }
					    ?>
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


			<!-- <h4 class="mb-3" style="font-size: 3rem;"><?php echo translate('checkout_title_2'); ?></h4> -->





			<input type="hidden" name="paymentMethod" value="Credit Card">

			<button type="submit" class="btn btn-primary btn-lg btn-block" style="background-image: none; background-color: #154cbf;"><?php echo translate('checkout_buy_button'); ?> <i class="fa-solid fa-shield-halved" style="font-weight: bold; transition: none; position: initial; margin-left: 2px;"></i></button>
			<hr style="margin: 10px;">
			<label class="text-secondary" style="font-size: 14px;text-align: center;margin: 0 auto;"><?php echo translate('cart_stripe_text'); ?></label>
			<hr style="margin: 8px;">
			
			<label class="text-secondary"><?php echo translate('checkout_final_info'); ?></label>

		</form>
		<hr>
	</div>
</div>


<script src="https://js.stripe.com/v3/"></script>

<script>
function validateForm() {
    var firstName = document.getElementById('firstName').value.trim();
    var lastName = document.getElementById('lastName').value.trim();
    var email = document.getElementById('email').value.trim();
    var establishment = document.getElementById('establishment').value.trim();
    var country = document.getElementById('country').value.trim();
    var zip = document.getElementById('zip').value.trim();
    var address = document.getElementById('address').value.trim();

    var nameRegex = /^[a-zA-Z\s\u00C0-\u00FF]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!firstName || !nameRegex.test(firstName)) {
        showSwalError('<?php echo translate('validate_first_name'); ?>');
        return false;
    }

    if (!lastName || !nameRegex.test(lastName)) {
        showSwalError('<?php echo translate('validate_last_name'); ?>');
        return false;
    }

    if (!email || !emailRegex.test(email)) {
        showSwalError('<?php echo translate('validate_email'); ?>');
        return false;
    }

    if (!establishment) {
        showSwalError('<?php echo translate('validate_establishment'); ?>');
        return false;
    }

    if (!country) {
        showSwalError('<?php echo translate('validate_country'); ?>');
        return false;
    }

    if (!zip) {
        showSwalError('<?php echo translate('validate_zip'); ?>');
        return false;
    }

    if (!address) {
        showSwalError('<?php echo translate('validate_address'); ?>');
        return false;
    }

    return true;
}

function showSwalError(text) {
    Swal.fire({
        icon: 'error',
        title: '<?php echo translate('validation_failed'); ?>',
        text: text,
        confirmButtonText: '<?php echo translate('validation_failed_btn'); ?>'
    });
}

document.getElementById('pagamento_final').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
</script>




<?php
include 'footer.php';
?>