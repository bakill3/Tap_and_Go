<?php
include 'header.php';
?>
<div class="container contact-form">
	<div class="contact-image">
		<img src="assets/img/hero/rocket-contact.png" alt="rocket_contact"/>
	</div>
	<form method="post">
		<h1>Contact Us</h1>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input type="text" name="txtName" class="form-control cool-input" placeholder="Your Name *" id="contact_name" value="" required />
				</div>
				<div class="form-group">
					<input type="text" name="txtEmail" class="form-control cool-input" placeholder="Your Email *" id="contact_email" value="" required />
				</div>
				<div class="form-group">
					<input type="text" name="txtPhone" class="form-control cool-input" placeholder="Your Phone Number *" id="contact_phone" value="" required />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<textarea name="txtMsg" class="form-control cool-input" placeholder="Your Message *" id="contact_message" style="width: 100%; height: 150px;"></textarea>
				</div>
			</div>

			
		</div>
		<hr>
		<div class="form-group">
			<button type="button" class="btnContact btn btn-lg" id="send_contact_message">Send Message</button>
		</div>
	</form>
</div>

<?php
include 'footer.php';
?>