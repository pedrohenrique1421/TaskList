<?php
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>
<!DOCTYPE html>
<html>
<head><title>Erro</title></head>
<body>
    <h2>Ocorreu um erro:</h2>
    <?php
    if ($erro === 'senha_incorreta') {
        echo "<p>Senha incorreta. Tente novamente.</p>";
    } elseif ($erro === 'email_nao_encontrado') {
        echo "<p>Email não encontrado. Verifique e tente de novo.</p>";
    } else {
        echo "<p>Erro desconhecido.</p>";
    }
    ?>
    <a href="../index.html">Voltar ao login</a>
</body>
</html>