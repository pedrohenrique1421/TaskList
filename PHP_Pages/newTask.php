<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskList</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <h2>Nova Tarefa</h2>
    <form method="post" action="../PHP/adicionarTarefa.php">
        <input type="text" name="titulo" placeholder="Título" required><br>
        <textarea name="descricao" placeholder="Descrição"></textarea><br>
        <button type="submit">Adicionar</button>
    </form>
</body>

</html>