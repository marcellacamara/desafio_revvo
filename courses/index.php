<?php
require '../db/db.php';

$stmt = $pdo->query("SELECT * FROM cursos");
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home - Cursos</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.1/dist/sweetalert2.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

	<?php include '../templates/header.php'; ?>

	<!-- Slideshow no topo -->
	<div class="slideshow-container">
		<div class="mySlides fade">
			<img src="../assets/imgs/banner-roxo.jpg" alt="Banner 1" style="width:100%">
		</div>
		<div class="mySlides fade">
			<img src="../assets/imgs/banner-2.jpg" alt="Banner 2" style="width:100%">
		</div>
		<div class="mySlides fade">
			<img src="../assets/imgs/banner-1.png" alt="Banner 3" style="width:100%">
		</div>

		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>
	</div>

	<div class="dot-container">
		<div class="dot-background"></div>
		<span class="dot" onclick="currentSlide(1)"></span>
		<span class="dot" onclick="currentSlide(2)"></span>
		<span class="dot" onclick="currentSlide(3)"></span>
	</div>

	<section class="meus-cursos">
		<h2>Meus Cursos</h2>
		<div class="grid-container">
			<?php foreach ($cursos as $curso): ?>
				<div class="curso-card">
					<img src="../uploads/<?= htmlspecialchars($curso['imagem']) ?>" alt="Imagem do Curso <?= htmlspecialchars($curso['titulo']) ?>">
					<h3><?= htmlspecialchars($curso['titulo']) ?></h3>
					<p><?= htmlspecialchars($curso['descricao']) ?></p>
					<a href="<?= htmlspecialchars($curso['link_slideshow']) ?>" target="_blank" class="botao">Ver Curso</a>

					<div class="card-actions">
						<a href="edit.php?id=<?= $curso['id'] ?>" class="btn-edit" title="Editar Curso">
							<i class="fas fa-edit"></i>
						</a>
						<a href="#" onclick="confirmDelete(<?= $curso['id'] ?>)" title="Deletar Curso"><i class="fas fa-trash"></i></a>
					</div>
				</div>
			<?php endforeach; ?>

			<div class="curso-card adicionar-curso">
				<a href="../courses/create.php">
					<i class="fas fa-plus-circle"></i>
					<h3>Adicionar Curso</h3>
				</a>
			</div>
		</div>
	</section>

	<?php include '../templates/footer.php'; ?>

	<div id="meuModal" class="modal">
		<div class="modal-content">
			<span class="fechar">&times;</span>
			<h2>Muito obrigada pela oportunidade!</h2>
			<p>Analisem com carinho e espero que gostem da mesma forma que gostei de desenvolver este desafio. Me sinto pronta para fazer parte do time da Revvo :)</p>
		</div>
	</div>

	<!-- Arquivo de scripts -->
	<script src="../assets/js/scripts.js"></script>

	<!-- Biblioteca do SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>