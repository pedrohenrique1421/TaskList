<?php
session_start();

if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    // Se não recebeu email ou senha, redireciona para login.html
    header("Location: ../index.html");
    exit;
}

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "task_list";

$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$email = trim($_POST['email']);
$senha_digitada = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erro no prepare: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha_digitada, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        header("Location: ../PHP_Pages/dashboard.php");
        exit;
    } else {
        // Debug opcional
        echo "Senha incorreta<br>";
        echo "Senha digitada: " . $senha_digitada . "<br>";
        echo "Hash no banco: " . $usuario['senha'];
        exit;
    }
} else {
    // Debug opcional
    header("Location: ../PHP_Pages/erro.php?erro=email_nao_encontrado");
    exit;
}
