<?php

if (isset($_GET['tema'])) {
    $opcao_tema = $_GET['tema'];
    setcookie("tema_usuario", $opcao_tema, time() + 3600, "/");
    
    
    header("Location: /att/cookie/at.php");
    exit;
}


if (isset($_GET['resetar'])) {
    setcookie("tema_usuario", "", time() - 3600, "/");
    
   
    header("Location: /att/cookie/at.php");
    exit;
}


$tema_atual = isset($_COOKIE['tema_usuario']) ? $_COOKIE['tema_usuario'] : 'claro';
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
            background-color: <?php echo $tema_atual === 'escuro' ? '#333' : '#fff'; ?>;
            color: <?php echo $tema_atual === 'escuro' ? '#fff' : '#333'; ?>;
        }
        a { color: #007BFF; margin-right: 15px; text-decoration: none; }
    </style>
</head>
<body>

    <h1>O tema atual é: <?php echo ucwords($tema_atual); ?></h1>
    <p>
        
        <a href="/att/cookie/at.php?tema=claro">Ativar Tema Claro</a>
        <a href="/att/cookie/at.php?tema=escuro">Ativar Tema Escuro</a>
        <a href="/att/cookie/at.php?resetar=1">Deletar Cookie (Resetar)</a>
    </p>

</body>
</html>
