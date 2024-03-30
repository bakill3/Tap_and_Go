<?php
include 'header.php';
?>

<section class="py-5 bg-light">
	<hr>
	<div style="padding-left: 6%; padding-right: 6%; padding-bottom: 6%;">
		<div class="section-tittle text-center mb-90" style="
	        margin-bottom: 50px;
	        ">
	        <h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em;">Our Products</h2>
	    </div>
		<div class="card-deck">
			<?php 
			$query = mysqli_query($link, "SELECT * FROM products");
			while ($info = mysqli_fetch_array($query)) {
				$id_produto = $info['id'];
				$nome_produto = $info['nome'];
				$descricao = $info['descricao'];
				$stock = $info['stock'];
				$imagem = $info['imagem_5_pack'];

				$price_pack_5 = $info['price_pack_5'];
				$price_pack_10 = $info['price_pack_10'];
				$price_pack_20 = $info['price_pack_20'];

				$short_description = substr($descricao,0,100).'...';

				$disabled = "";
				if ($stock == 0) {
					$disabled = "pointer-events: none;cursor: default;";
					$btn_text = "<span style='color: red; font-weight: 700; color: #330000;'>Out of Stock</span>";
				} else {
					$btn_text = "<span style='font-weight: 600;'>Check Product</span>";
				}


				echo " 
					<div class='card'>
						<img src='$imagem' class='card-img-top' alt='...'>
						<div class='card-body'>
							<h1 class='card-title' style='font-family: \"Manrope\", sans-serif;'>$nome_produto</h1>
							<p class='card-text'>$short_description</p>
						</div>
						<div class='card-footer' style='text-align: center;'>
							<a href='index.php?id=$id_produto&qnt=5' class='btn btn-lg btn-primary' style='background-image: none; background-color: #007bff; width: 100%; $disabled; font-size: 90%;'>$btn_text</a>
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