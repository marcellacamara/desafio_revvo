<?php
require '../db/db.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = ?");
	$stmt->execute([$id]);
	$curso = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$curso) {
		die("Curso não encontrado.");
	}
} else {
	die("ID do curso não fornecido.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$link_slideshow = $_POST['link_slideshow'];

	if (!empty($_FILES['imagem']['name'])) {
		$imagem = $_FILES['imagem']['name'];
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($imagem);

		if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
			$stmt = $pdo->prepare("UPDATE cursos SET titulo = ?, descricao = ?, imagem = ?, link_slideshow = ? WHERE id = ?");
			$stmt->execute([$titulo, $descricao, $imagem, $link_slideshow, $id]);
		} else {
			echo "Erro ao enviar a nova imagem.";
		}
	} else {
		$stmt = $pdo->prepare("UPDATE cursos SET titulo = ?, descricao = ?, link_slideshow = ? WHERE id = ?");
		$stmt->execute([$titulo, $descricao, $link_slideshow, $id]);
	}

	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Curso</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
	<div class="edit-container">
		<div class="edit-course-form">
			<h2>Editar Curso</h2>

			<form action="edit.php?id=<?= $curso['id'] ?>" method="post" enctype="multipart/form-data">
				<div class="edit-course-form-group">
					<label for="edit-titulo">Título:</label>
					<input type="text" name="titulo" id="edit-titulo" value="<?= htmlspecialchars($curso['titulo']) ?>" required>
				</div>

				<div class="edit-course-form-group">
					<label for="edit-descricao">Descrição:</label>
					<textarea name="descricao" id="edit-descricao" required><?= htmlspecialchars($curso['descricao']) ?></textarea>
				</div>

				<div class="edit-course-form-group">
					<label for="imagem">Imagem Atual:</label><br>
					<img class="edit-course-img" src="uploads/<?= htmlspecialchars($curso['imagem']) ?>" alt="Imagem do Curso"><br><br>

					<label for="imagem">Nova Imagem (opcional):</label>
					<input type="file" name="imagem" id="edit-imagem">
				</div>

				<div class="edit-course-form-group">
					<label for="edit-link_slideshow">Link do Slideshow:</label>
					<input type="text" name="link_slideshow" id="edit-link_slideshow" value="<?= htmlspecialchars($curso['link_slideshow']) ?>" required>
				</div>

				<div class="edit-course-form-group">
					<button type="submit" class="edit-btn-submit">Salvar</button>
				</div>
			</form>

			<div class="edit-back-link">
				<a href="index.php">Voltar para a Lista de Cursos</a>
			</div>
		</div>
	</div>
</body>

</html>