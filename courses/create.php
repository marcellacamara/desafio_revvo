<?php

require '../db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$link_slideshow = $_POST['link_slideshow'];
	$imagem = $_FILES['imagem']['name'];
	$target_dir = "../uploads/";
	$target_file = $target_dir . basename($imagem);

	if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
		try {
			$stmt = $pdo->prepare("INSERT INTO cursos (titulo, descricao, imagem, link_slideshow) VALUES (?, ?, ?, ?)");
			$stmt->execute([$titulo, $descricao, $imagem, $link_slideshow]);
			header("Location: index.php");
			exit();
		} catch (PDOException $e) {
			echo "Erro ao cadastrar o curso: " . $e->getMessage();
		}
	} else {
		echo "Erro ao enviar a imagem.";
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/styles.css">
	<title>Adicionar Novo Curso</title>
</head>

<body>
	<div class="create-container">
		<div class="create-course-form">
			<h2>Adicionar Novo Curso</h2>
			<form action="create.php" method="POST" enctype="multipart/form-data">
				<div class="create-course-form-group">
					<label for="titulo">Título:</label>
					<input type="text" id="create-titulo" name="titulo" class="create-input" required>
				</div>

				<div class="create-course-form-group">
					<label for="descricao">Descrição:</label>
					<textarea id="create-descricao" name="descricao" rows="5" class="create-textarea" required></textarea>
				</div>

				<div class="create-course-form-group">
					<label for="imagem">Imagem:</label>
					<input type="file" id="create-imagem" name="imagem" class="create-input" required>
				</div>

				<div class="create-course-form-group">
					<label for="link_slideshow">Link do Slideshow:</label>
					<input type="text" id="create-link_slideshow" name="link_slideshow" class="create-input" required>
				</div>

				<div class="create-course-form-group">
					<button type="submit" class="create-btn-submit">Adicionar Curso</button>
				</div>
			</form>

			<div class="create-back-link">
				<a href="index.php">Voltar para a Lista de Cursos</a>
			</div>
		</div>
	</div>
</body>

</html>