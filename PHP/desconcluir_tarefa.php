<?php
session_start();
if (!isset($_SESSION['usuario_id'])) exit;

$id = $_POST['id'];
$usuario_id = $_SESSION['usuario_id'];

$conn = new mysqli("localhost", "root", "", "task_list");

$stmt = $conn->prepare("UPDATE tarefas SET concluida = 0 WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();

header("Location: ../PHP_Pages/dashboard.php");
exit;
