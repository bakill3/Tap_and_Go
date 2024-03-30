<?php
include 'header.php';

if (isset($_POST['login_admin'])) {
	$password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));
	if ($password == "(6!9Y9aE)Urg") {
		$_SESSION['admin'] = 1;
		echo "<script>window.location.href='criar_link.php';</script>";
	}
}

if (isset($_POST['adicionar_local'])) {
	$nome_local = htmlspecialchars(mysqli_real_escape_string($link, $_POST['nome_local']));
	$link_local = $_POST['link_local'];

	if (!empty($nome_local) && !empty($link_local)) {

        // Check for uploaded file
		if (isset($_FILES['uploaded_image'])) {

			$file_tmp = $_FILES['uploaded_image']['tmp_name'];
			$file_name = basename($_FILES['uploaded_image']['name']);

            // Ensure the directory exists
			$dir = __DIR__ . "/assets/img/uploaded_locals/";
			if (!is_dir($dir)) {
				echo "The directory does not exist.";
                exit; // Exit the script if directory doesn't exist
            }
            
            $target_file = $dir . $file_name;
            
            // Attempt to move the uploaded file to the target location
            if (move_uploaded_file($file_tmp, $target_file)) {
            	echo "The file has been uploaded.";
            } else {
            	echo "There was an error uploading your file.";
                exit; // Exit the script if there's an error in moving the file
            }
            $image_final = "/assets/img/uploaded_locals/".$file_name;
            
            // At this point, the file is uploaded successfully, so we proceed to the database insertion
            mysqli_query($link, "INSERT INTO locals(nome_local, link_local, logo_url) VALUES('$nome_local', '$link_local', '$image_final');") or die(mysqli_error($link));
            
            $id_local = mysqli_insert_id($link);
            $link_redirect = "https://tapgotech.com/redirect.php?id=$id_local";
            
            //session_destroy();  // Uncomment this if you want to destroy the session
            
            $_SESSION['admin_link'] = $link_redirect;
            echo "<script>window.location.href='criar_link.php';</script>";
        } else {
        	echo "No file was uploaded.";
        }
    }
}
?>
<div class="container" style="padding: 5%;">

	<?php 
	if (isset($_SESSION['admin_link'])) {
		?>
		<div class="section-tittle text-center mb-90">
			<h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em;">Local Adicionado com Sucesso</h2>
			<h3>Link: <a href="<?php echo $_SESSION['admin_link']; ?>" target='_blank' style="color: blue;"><?php echo $_SESSION['admin_link']; ?></a></h3>
			<p>Agora imprime este link no NFC Card. Não o percas, porque senão, vais chatear o Gabriel, e ele ou está a beber, ou a pinar :)</p>
		</div>
		<hr>
		<?php
	//session_destroy();
	}
	?>
	<div class="section-tittle text-center mb-90">
		<h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em;">Adicionar Establecimento</h2>
	</div>

	<?php 
	if (!isset($_SESSION['admin'])) {
		?>
		<form method="POST">
			<label>Password:</label>
			<input type="password" class="form-control" name="password" required>
			<button type="submit" name="login_admin" class="btn btn-lg btn-primary" style="width: 100%; margin: 1%;">PEGA</button>
		</form>
		<?php 
	} else {
		?>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nome do Local</label>
				<input type="text" class="form-control" placeholder="Nome do Establecimento" name="nome_local" required>
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<label>Link</label>
				<input type="text" class="form-control" placeholder="Link Google Maps" name="link_local" value="https://search.google.com/local/writereview?placeid=ID" required>
				<small class="form-text text-muted">Para encontrar o id do link, carrega <a href='https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder#maps_places_placeid_finder-typescript' target="_blank" style="color: blue;">aqui</a>.</small>
			</div>
			<div class="form-group">
				<label>Upload Logo</label>
				<input type="file" class="form-control" name="uploaded_image" required>
			</div>
			<button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin: 1%;" name="adicionar_local">Adicionar</button>
		</form>


		<?php
// Assuming you have already established a database connection named $link
		$result = mysqli_query($link, "SELECT l.*, COUNT(ll.id_link) AS link_count FROM locals l LEFT JOIN locals_links ll ON l.id_local = ll.id_local GROUP BY l.id_local");
$modals = ""; // This variable will store all our modals
?>

<div class="section-tittle text-center mb-90">
	<h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em; margin-top: 10%;">Establecimentos</h2>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Local</th>
				<th scope="col">Imagem</th>
				<th scope="col">Link</th>
				<th scope="col">Accessos</th>
				<th scope="col">Detalhes</th>
				<th scope="col">Edit</th> 
				<th scope="col">Delete</th> 
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result)): ?>
				<tr id="coluna_<?php echo $row['id_local']; ?>">
					<th scope="row"><?php echo $row['id_local']; ?></th>
					<td id="nome_local_<?php echo $row['id_local']; ?>"><?php echo $row['nome_local']; ?></td>
					<td><img src="<?php echo $row['logo_url']; ?>" alt="Logo" width="50px" id="imagem_local_<?php echo $row['id_local']; ?>"></td>
					<td><a href="https://tapgotech.com/redirect.php?id=<?php echo $row['id_local']; ?>" target="_blank" style="color: blue;">https://tapgotech.com/redirect.php?id=<?php echo $row['id_local']; ?></a></td>
					<td><?php echo $row['link_count']; ?></td>
					<td>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#localDetailsModal<?php echo $row['id_local']; ?>" style="background-image: none;">Stats</button>
					</td>
					<td>
						<button type="button" class="btn btn-info btn-edit" data-id="<?php echo $row['id_local']; ?>" style="background-image: none;">Edit</button>
					</td>

					<!-- Delete Button -->
					<td>
						<button type="button" class="btn btn-danger btn-delete" data-id="<?php echo $row['id_local']; ?>" style="background-image: none;">Delete</button>
					</td>
				</tr>
				
				<?php
				$modals .= '<div class="modal fade" id="localDetailsModal' . $row['id_local'] . '" tabindex="-1" aria-labelledby="localDetailsLabel' . $row['id_local'] . '" aria-hidden="true">
				<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title text-nice" id="localDetailsLabel' . $row['id_local'] . '">Details for ' . $row['nome_local'] . '</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				<tr>
				<th>IP</th>
				<th>Browser</th>
				<th>OS</th>
				<th>Date</th>
				</tr>
				</thead>
				<tbody>';

				$details_result = mysqli_query($link, "SELECT * FROM locals_links WHERE id_local='{$row['id_local']}'");
				while ($detail = mysqli_fetch_assoc($details_result)): 
					$modals .= '<tr>
					<td>' . $detail['ip'] . '</td>
					<td>' . $detail['browser'] . '</td>
					<td>' . $detail['sistema_operativo'] . '</td>
					<td>' . $detail['data'] . '</td>
					</tr>';
				endwhile;
				
				$modals .= '		</tbody>
				</table>
				</div>
				</div>
				</div>
				</div>
				</div>';
				?>
				
			<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php
// After the main table, we echo all the stored modals
echo $modals;
?>


<?php 
}
?>
</div>
<?php
include 'footer.php';
?>