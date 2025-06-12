<?php
session_start();
if (!isset($_SESSION['usuario_id'])) exit;

$novo_nome = trim($_POST['novo_nome']);
$usuario_id = $_SESSION['usuario_id'];

$conn = new mysqli("localhost", "root", "", "task_list");

$stmt = $conn->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
$stmt->bind_param("si", $novo_nome, $usuario_id);
$stmt->execute();

// Atualiza a sessão
$_SESSION['nome'] = $novo_nome;

header("Location: ../PHP_Pages/dashboard.php");
exit;
