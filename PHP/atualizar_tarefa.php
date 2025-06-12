<?php
session_start();
if (!isset($_SESSION['usuario_id'])) exit;

$conn = new mysqli("localhost", "root", "", "task_list");

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("UPDATE tarefas SET titulo = ?, descricao = ? WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ssii", $titulo, $descricao, $id, $usuario_id);
$stmt->execute();

header("Location: ../PHP_Pages/dashboard.php");
exit;
