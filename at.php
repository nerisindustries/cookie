<?php

if (isset($_GET['tema'])) {
    $opcao_tema = $_GET['tema'];
    
    
    setcookie("tema_usuario", $opcao_tema, time() + 3600, "/");
    
    
    header("Location: index.php");
    exit;
}


$tema_atual = isset($_COOKIE['tema_usuario']) ? $_COOKIE['tema_usuario'] : 'claro';


if (isset($_GET['resetar'])) {
    setcookie("tema_usuario", "", time() - 3600, "/");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exemplo de Cookie no PHP</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 40px; 
            /* Muda a cor de fundo baseado no valor do cookie */
            background-color: <?php echo $tema_atual === 'escuro' ? '#333' : '#fff'; ?>;
            color: <?php echo $tema_atual === 'escuro' ? '#fff' : '#333'; ?>;
        }
        a { color: #007BFF; margin-right: 15px; text-decoration: none; }
    </style>
</head>
<body>

    <h1>O tema atual é: <?php echo ucwords($tema_atual); ?></h1>

    
    <p>
        <a href="index.php?tema=claro">Ativar Tema Claro</a>
        <a href="index.php?tema=escuro">Ativar Tema Escuro</a>
        <a href="index.php?resetar=1">Deletar Cookie (Resetar)</a>
    </p>

    <p>Dica: Modifique o tema e atualize a página manualmente para ver que a sua escolha permanece salva!</p>

</body>
</html>
