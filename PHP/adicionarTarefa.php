<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

$conn = new mysqli("localhost", "root", "", "task_list");

$stmt = $conn->prepare("INSERT INTO tarefas (usuario_id, titulo, descricao) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $usuario_id, $titulo, $descricao);
$stmt->execute();

header("Location: ../PHP_Pages/dashboard.php");
exit;
?>
