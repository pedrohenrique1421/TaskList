<?php
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Erro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <h1>Ocorreu um erro:</h1>
    <?php
    if ($erro === 'senha_incorreta') {
        echo "<h2>Senha incorreta. Tente novamente.</h2>";
    } elseif ($erro === 'email_nao_encontrado') {
        echo "<h2>Email não encontrado. Verifique e tente de novo.</h2>";
    } else {
        echo "<h2>Erro desconhecido.</h2>";
    }
    ?>
    <a href="../index.html">Voltar ao login</a>
</body>

</html>