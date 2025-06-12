<?php
session_start();
if (!isset($_SESSION['usuario_id'])) exit;

$usuario_id = $_SESSION['usuario_id'];

$conn = new mysqli("localhost", "root", "", "task_list");

// Primeiro: excluir todas as tarefas do usuário
$stmt1 = $conn->prepare("DELETE FROM tarefas WHERE usuario_id = ?");
$stmt1->bind_param("i", $usuario_id);
$stmt1->execute();

// Depois: excluir o usuário
$stmt2 = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt2->bind_param("i", $usuario_id);
$stmt2->execute();

// Destroi a sessão e redireciona
session_destroy();
header("Location: ../index.html");
exit;
