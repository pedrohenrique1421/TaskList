<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
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
    <h1><?php echo $_SESSION['nome']; ?></h1>

    <h2>Alterar Nome</h2>
    <form method="post" action="../PHP/alterar_nome.php">
        <input type="text" name="novo_nome" value="<?php echo htmlspecialchars($_SESSION['nome']); ?>" required>
        <button type="submit">Salvar</button>
    </form>
    <br><br>
    <form method="post" action="../PHP/excluir_conta.php" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Essa ação é irreversível!');">
        Excluir Conta: <button type="submit" style="background-color: #f00;">Excluir Conta</button>
    </form>
    <br>
    <button onclick="history.back()">Voltar</button>
</body>

</html>