<?php
require '../db/db.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$stmt = $pdo->prepare("SELECT * FROM cursos WHERE id = ?");
	$stmt->execute([$id]);
	$curso = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($curso) {
		$imagem = 'uploads/' . $curso['imagem'];
		if (file_exists($imagem)) {
			unlink($imagem);
		}

		$stmt = $pdo->prepare("DELETE FROM cursos WHERE id = ?");
		$stmt->execute([$id]);

		header("Location: index.php");
		exit();
	} else {
		die("Curso não encontrado.");
	}
} else {
	die("ID do curso não fornecido.");
}
