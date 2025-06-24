<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>

<head>
    <title>TaskList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
    <a href="user_edit.php">editar perfil</a>
    <br>
    <a href="../PHP/logout.php">Desconectar</a>
    <h2>Minhas Tarefas</h2>

    <?php
    $conn = new mysqli("localhost", "root", "", "task_list");
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE usuario_id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    echo "<ul>";
    while ($tarefa = $resultado->fetch_assoc()) {
        echo "<li>";
        echo "<strong>" . htmlspecialchars($tarefa['titulo']) . "</strong>: " . htmlspecialchars($tarefa['descricao']);
        echo $tarefa['concluida'] ? " ✅" : " ❌";

        // Botões de ação
        echo "
        <br>
        <form style='display:inline;' method='post' action='../PHP/concluir_tarefa.php'>
            <input type='hidden' name='id' value='{$tarefa['id']}'>
            <button type='submit'>Concluir</button>
        </form>

        <form style='display:inline;' method='post' action='../PHP/desconcluir_tarefa.php'>
            <input type='hidden' name='id' value='{$tarefa['id']}'>
            <button type='submit'>Resetar</button>
        </form>

        <form style='display:inline;' method='post' action='../PHP/excluir_tarefa.php'>
            <input type='hidden' name='id' value='{$tarefa['id']}'>
            <button type='submit' onclick='return confirm(\"Tem certeza?\")'>Excluir</button>
        </form>

        <form style='display:inline;' method='get' action='editar_tarefa.php'>
            <input type='hidden' name='id' value='{$tarefa['id']}'>
            <button type='submit'>Editar</button>
        </form>
    ";

        echo "</li>";
    }
    echo "</ul>";
    ?>
    <br>
    <a href="newTask.php">Criar nova tarefa</a>
</body>

</html>