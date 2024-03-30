<?php 
if (1 == 1) {
	echo "<script>window.location.href='index.php?id=1&qnt=1';</script>";
}
include 'header.php';
if (isset($_GET['id'])) {
	$id = htmlspecialchars(mysqli_real_escape_string($link, $_GET['id']));
	$id = preg_replace('/[^0-9]/', '', $id);

	if (!isset($_GET['qnt'])) {
		echo "<script>window.location.href='product.php?id=1&qnt=5';</script>";
	}

	$qnt = htmlspecialchars(mysqli_real_escape_string($link, $_GET['qnt']));
	$qnt = preg_replace('/[^0-9]/', '', $qnt);

	if ($qnt == 5 || $qnt == 10 || $qnt == 20) {
		//funcionou
	} else {
		echo "<script>window.location.href='index.php';</script>";
	}

	$query = mysqli_query($link, "SELECT * FROM products WHERE id='$id'");
	if (mysqli_num_rows($query) == 0) {
		echo "<script>window.location.href='product.php?id=$id&qnt=5';</script>";
	} else {
		while ($info = mysqli_fetch_array($query)) {
			$nome = $info['nome'];
			$descricao = $info['descricao'];
			$price_pack_5 = $info['price_pack_5'];
			$price_pack_10 = $info['price_pack_10'];
			$price_pack_20 = $info['price_pack_20'];
			$stock = $info['stock'];
			$imagem_5_pack = $info['imagem_5_pack'];
			$imagem_10_pack = $info['imagem_10_pack'];
			$imagem_20_pack = $info['imagem_20_pack'];


			if ($qnt == 5) {
				$imagem = $imagem_5_pack;
				$price = $price_pack_5;
			} elseif ($qnt == 10) {
				$imagem = $imagem_10_pack;
				$price = $price_pack_10;
			} elseif ($qnt == 20) {
				$imagem = $imagem_20_pack;
				$price = $price_pack_20;
			}
		}
	}
} else {
	echo "<script>window.location.href='index.php';</script>";
}

$extra_price = $price + 25;


if (isset($_SESSION['produto_adicionado'])) {
	echo "<script>
	document.addEventListener('DOMContentLoaded', function() {
		const cartContainer = document.querySelector('.cart-container');
		cartContainer.classList.add('active');
		});
		</script>";
		unset($_SESSION['produto_adicionado']);
	}
	?>
	<section id="product_section" class="py-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;" >
		<div class="container px-4 px-lg-5 my-5">
			<div class="row gx-4 gx-lg-5 align-items-center">
				<div class="col-md-6">
					<div class="image-icons-container" style="text-align: center;">
						<img id="imagem_produto" class="card-img-top mb-5 mb-md-0" src="<?php echo $imagem; ?>" loading="lazy" alt="..." style='border-radius: 5%; width: 85%;'/>
						<div class="icons-row">
							<img id="google_link" src="https://img.icons8.com/color/240/google-logo.png" loading="lazy" alt="Google Icon" class="platform-icon-product" data-id="1">
							<img id="tripadvisor_link" src="https://img.icons8.com/color/240/tripadvisor.png" loading="lazy" alt="TripAdvisor Icon" class="platform-icon-product" data-id="4">
							<img id="instagram_link" src="https://img.icons8.com/fluency/240/instagram-new.png" loading="lazy" alt="Instagram Icon" class="platform-icon-product" data-id="5">
							<img id="whatsapp_link" src="https://img.icons8.com/color/240/whatsapp--v1.png" loading="lazy" alt="WhatsApp Icon" class="platform-icon-product" data-id="6">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="small mb-1"><!-- text --></div>
					<h1 class="display-5 fw-bolder text-center-mobile" style="font-family: 'Suisse Intl', sans-serif !important; font-weight: 800; font-size: xx-large; margin-top: 10px !important; margin-bottom: 10px !important;"><?php echo "<span id='qnt_title'>".$qnt."</span> <span id='title_type'>".$nome; ?></span></h1>
					<div class="fs-5 mb-5 text-center-mobile" style="font-size: large; margin-bottom: 2rem !important;">
						<span id="product_price_display" style="font-weight: 700; font-size: 30px; color: #53c57f !important;"><?php echo $price; ?> €</span>
						<span class="text-decoration-line-through" style="text-decoration: line-through; color: #b20202;" id="product_extra_price_display"><?php if (!empty($extra_price)) { echo $extra_price." €"; } ?></span>
						
					</div>

					<p class="lead" id="description_product" style="font-family: 'Suisse Intl', sans-serif !important; font-size: initial !important;"><?php echo $descricao; ?></p>
					<input type="hidden" id="id_produto" value="<?php echo $id; ?>">
					<input type="hidden" id="qnt" value="<?php echo $qnt; ?>">
					<div class="d-flex">

						<button class="btn btn-outline-dark flex-shrink-0" type="button" id="add_to_cart" style="background-image: none;
						background-color: #154cbf;
						font-family: 'Work Sans';" <?php if ($stock == '0') { echo "disabled"; } ?>>
						<?php if ($stock == '0') { echo "<span style='color: red; font-weight: 700; color: #330000;'>Out of Stock</span>"; } else { echo "Add to Cart"; } ?>
					</button>

				</div>
				<hr id="hr_product">
				<div class="container mt-4">
					<div class="btn-group btn-group-toggle d-flex flex-column flex-sm-row text-center" >
						<button class="btn btn-outline-secondary btns_packs" style="background-image: none !important;" data-qnt="5">
							Basic Pack <hr style="margin: 3%;">
						</button>
						<button class="btn btn-outline-secondary btns_packs" style="background-image: none !important;" data-qnt="10">
							Valued Pack <hr style="margin: 3%;">
						</button>
						<button class="btn btn-outline-secondary btns_packs" style="background-image: none !important;" data-qnt="20">
							Premium Pack <hr style="margin: 3%;">
						</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<hr>

<section class="office-environments" style="background-color: white;">
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="position: relative; width: 100%; padding-bottom: 56.25%; overflow: hidden; border-radius: 10px;">
				<video src="cards.mp4" controls autoplay loop muted style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
					Your browser does not support the video tag.
				</video>
			</div>
			<div class="col-md-6">
				<div class="office-pera">
					<div class="section-tittle">
						<h2 class="mb-30">Boost Your Business with Next-Gen Review Technology!</h2>
						<p>Boost customer engagement and skyrocket your Google ratings with our cutting-edge NFC and QR Code solution. Say goodbye to tedious review processes and welcome the future of effortless, instant feedback. Stay ahead of the competition and watch your business thrive with real-time insights and easy implementation. Elevate your reviews to new heights today!</p>
						<a href="#" class="btn">About Us</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>




<section class="py-5 bg-light" style="background-color: white !important;">
	<div class="container px-4 px-lg-5 mt-5">
		<div class="section-tittle text-center mb-90" style="margin-bottom: 50px;">
			<h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em;">Related Products</h2>
		</div>
		<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
			<?php 
			$query = mysqli_query($link, "SELECT * FROM products WHERE stock > 0");
			while ($info = mysqli_fetch_array($query)) {
				$id_produto = $info['id'];
				$nome_produto = $info['nome'];
				$descricao = $info['descricao'];
				$stock = $info['stock'];
				$imagem = $info['imagem_5_pack'];

				$price_pack_5 = $info['price_pack_5'];
				$price_pack_10 = $info['price_pack_10'];
				$price_pack_20 = $info['price_pack_20'];

				if ($qnt == 5) {
					$price = $price_pack_5;
				} elseif ($qnt == 10) {
					$price = $price_pack_10;
				} elseif ($qnt == 20) {
					$price = $price_pack_20;
				}

				echo " 

				<div class='col mb-5'>
				<div class='card h-100'>
				<!-- Product image-->
				<img class='card-img-top' src='$imagem' alt='...' />
				<!-- Product details-->
				<div class='card-body p-4'>
				<div class='text-center'>
				<!-- Product name-->
				<h5 class='fw-bolder'>$nome_produto</h5>
				<!-- Product price-->
				$price €
				</div>
				</div>
				<!-- Product actions-->
				<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
				<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='product.php?id=$id_produto&qnt=5'>Check Product</a></div>
				</div>
				</div>
				</div>

				";
			}
			?>

		</div>
	</div>
</section>
<?php 
include 'footer.php';
?>