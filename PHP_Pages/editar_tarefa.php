<?php
session_start();
if (!isset($_SESSION['usuario_id'])) exit;

$conn = new mysqli("localhost", "root", "", "task_list");

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$tarefa = $resultado->fetch_assoc();
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
    <h2>Editar Tarefa</h2>
    <form method="post" action="../PHP/atualizar_tarefa.php">
        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required><br>
        <textarea name="descricao"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea><br>
        <button type="submit">Salvar</button>
    </form>
</body>

</html>