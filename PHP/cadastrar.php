<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "task_list";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    header("Location: ../index.html");
    exit;
} else {
    header("Location: ../PHP_Pages/erro.php?erro=cadastro_falhou");
    exit;
}

$conn->close();
?>
