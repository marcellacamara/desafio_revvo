<?php
// Conexão com o banco de dados
$host = 'localhost';
$db = 'desafio_revvo';
$user = 'root';
$pass = 'root';

require 'db/db.php';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
	$pdo = new PDO($dsn, $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Erro ao conectar: ' . $e->getMessage());
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$cursos = [
	[
		'imagem' => 'php-poo.jpg',
		'titulo' => 'PHP POO',
		'descricao' => 'POO com PHP, explicando conceitos como Classes, Objetos e Herança.',
		'link_slideshow' => 'https://www.cursoemvideo.com/curso/php-poo/',
	],
	[
		'imagem' => 'bootcamp-orange-tech.webp',
		'titulo' => 'Bootcamp Orange Tech+',
		'descricao' => 'Bootcamp com foco em front-end e back-end utilizando JavaScript e React.',
		'link_slideshow' => 'https://github.com/marcellacamara/bootCampOrangeTech',
	],
	[
		'imagem' => 'CS50.webp',
		'titulo' => 'CS50',
		'descricao' => 'Curso de Ciência da Computação da Harvard, no Brasil.',
		'link_slideshow' => 'https://www.estudarfora.org.br/cursos/cc50/',
	],
	[
		'imagem' => 'curso-de-seguranca-em-aplicacoes-web-com-php.png',
		'titulo' => 'Segurança Web com PHP',
		'descricao' => 'Boas práticas de segurança no desenvolvimento de aplicações web.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/seguranca-aplicacoes-web-com-php',
	],
	[
		'imagem' => 'laravel.png',
		'titulo' => 'Laravel 11 Completo',
		'descricao' => 'Curso completo de Laravel 11 com enfoque em desenvolvimento ágil.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/laravel-11-completo-e-gratuito',
	],
	[
		'imagem' => 'laravel.png',
		'titulo' => 'Laravel 10 Gratuito',
		'descricao' => 'Curso para aprender Laravel 10, focando nas melhores práticas do framework.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/laravel-10-gratuito',
	],
	[
		'imagem' => 'laravel.png',
		'titulo' => 'Laravel 9 Gratuito',
		'descricao' => 'Curso de Laravel 9, cobrindo os conceitos essenciais do framework.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/laravel-9-gratuito',
	],
	[
		'imagem' => 'curso-laravel-banco-de-dados-relacional.png',
		'titulo' => 'Banco de Dados Relacional',
		'descricao' => 'Como utilizar relacionamentos de tabelas no Laravel com o Eloquent.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/laravel-banco-de-dados-relacional',
	],
	[
		'imagem' => 'curso-laravel-8.png',
		'titulo' => 'Introdução ao Laravel 8',
		'descricao' => 'Curso introdutório para começar no Laravel 8.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/introducao-ao-laravel-8',
	],
	[
		'imagem' => 'curso-laravel-6.png',
		'titulo' => 'Laravel 6.x Gratuito',
		'descricao' => 'Curso de Laravel 6 com conceitos fundamentais do framework.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/curso-laravel-6',
	],
	[
		'imagem' => 'php-poo.jpg',
		'titulo' => 'Fundamentos de PHP',
		'descricao' => 'Curso que cobre os conceitos principais da linguagem PHP.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/fundamentos-programacao-php-7',
	],
	[
		'imagem' => 'php-poo.jpg',
		'titulo' => 'PHP PSRs (Boas Práticas)',
		'descricao' => 'Guia essencial sobre boas práticas e padrões de programação PHP.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/php-psrs-boas-praticas',
	],
	[
		'imagem' => 'curso-design-patterns.png',
		'titulo' => 'Design Patterns',
		'descricao' => 'Curso sobre os 22 padrões de design aplicados ao desenvolvimento PHP.',
		'link_slideshow' => 'https://academy.especializati.com.br/curso/design-patterns',
	],
];

// Função para verificar permissões do diretório e ajustar
function verificarPermissoes($diretorio)
{
	if (!is_dir($diretorio)) {
		mkdir($diretorio, 0775, true);
	}

	if (!is_writable($diretorio)) {
		chmod($diretorio, 0775);
	}
}

// Verificar e ajustar permissões da pasta uploads
$target_dir = 'uploads/';
verificarPermissoes($target_dir);

// Função para copiar a imagem
function copiarImagem($imagem_nome)
{
	$imagem_origem = 'imgs/' . $imagem_nome;
	$imagem_destino = 'uploads/' . $imagem_nome;

	if (file_exists($imagem_origem)) {
		if (copy($imagem_origem, $imagem_destino)) {
			echo "Imagem {$imagem_nome} copiada com sucesso para uploads!<br>";
		} else {
			echo "Erro ao copiar a imagem {$imagem_nome}.<br>";
		}
	} else {
		echo "A imagem {$imagem_nome} não foi encontrada na pasta imgs!<br>";
	}
}

// Inserir cursos e copiar as imagens para a pasta uploads
foreach ($cursos as $curso) {
	copiarImagem($curso['imagem']);

	try {
		$stmt = $pdo->prepare("INSERT INTO cursos (titulo, descricao, imagem, link_slideshow) VALUES (?, ?, ?, ?)");
		$stmt->execute([$curso['titulo'], $curso['descricao'], $curso['imagem'], $curso['link_slideshow']]);
		echo "Curso " . $curso['titulo'] . " inserido com sucesso!<br>";
	} catch (PDOException $e) {
		echo "Erro ao inserir o curso " . $curso['titulo'] . ": " . $e->getMessage() . "<br>";
	}
}

echo "Seed concluído!";
