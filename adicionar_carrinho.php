<?php
include 'ligar_db.php';

$response = ['status' => 'error', 'message' => 'Unknown error.'];

// Check if the id_produto POST parameter is set
if (isset($_POST['id_produto']) && isset($_POST['qnt'])) {
	$id = htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_produto']));
	$qnt = htmlspecialchars(mysqli_real_escape_string($link, $_POST['qnt']));

    // Fetch product details from the database
	$query = mysqli_query($link, "SELECT * FROM products WHERE id='$id'");

	if (mysqli_num_rows($query) > 0) {
		$info = mysqli_fetch_assoc($query);

		$nome = $info['nome'];
		$descricao = $info['descricao'];
		$price_pack_1 = $info['price_pack_1'];
		$price_pack_5 = $info['price_pack_5'];
		$price_pack_10 = $info['price_pack_10'];
		$price_pack_20 = $info['price_pack_20'];
		$stock = $info['stock'];
		$imagem_1_pack = $info['imagem_1_pack'];
		$imagem_5_pack = $info['imagem_5_pack'];
		$imagem_10_pack = $info['imagem_10_pack'];
		$imagem_20_pack = $info['imagem_20_pack'];

		if ($qnt == 1) {
			$imagem = $imagem_1_pack;
			$price = $price_pack_1;
		} elseif ($qnt == 5) {
			$imagem = $imagem_5_pack;
			$price = $price_pack_5;
		} elseif ($qnt == 10) {
			$imagem = $imagem_10_pack;
			$price = $price_pack_10;
		} elseif ($qnt == 20) {
			$imagem = $imagem_20_pack;
			$price = $price_pack_20;
		}

		$nome_sessao = $qnt." ".$nome;
		$item_array = array(
			'item_id'        =>     $id,
			'item_name'      =>     $nome_sessao,
			'item_price'     =>     $price,
			'item_quantity'  =>     1,
			'qnt_pack' => $qnt,
			'item_imagem' => $imagem,
			'item_description' => $descricao
		);

        // Logic for adding to the cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'][] = $item_array;
		} else {
			$itemExists = false;
			foreach ($_SESSION['cart'] as $key => $item) {
                // Check both the item_id and qnt_pack
				if ($item['item_id'] == $id && $item['qnt_pack'] == $qnt) {
					$_SESSION['cart'][$key]['item_quantity'] += 1;
					$itemExists = true;
					break;
				}
			}

			if (!$itemExists) {
				$_SESSION['cart'][] = $item_array;
			}
		}

        // Get the key (index) of the product that was just added
		$last_added_key = array_key_last($_SESSION['cart']);

		$response = [
			'status' => 'success',
			'message' => 'Product added to cart successfully!',
			'product' => [
				'id' => $id,
				'name' => $nome_sessao,
				'image' => $imagem,
				'price' => $price,
				'item_quantity' => 1,
				'qnt_pack' => $qnt,
                'key' => $last_added_key // Add the key to the response
            ]
        ];
    } else {
    	$response = ['status' => 'error', 'message' => 'Product not found.'];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>


