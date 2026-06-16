<?php

if (isset($_POST['salvar'])) {
    $nome_usuario = $_POST['nome'];
    $idade_usuario = $_POST['idade'];
    
    
    setcookie("usuario_nome", $nome_usuario, time() + 3600, "/");
    setcookie("usuario_idade", $idade_usuario, time() + 3600, "/");
    
    
    header("Location: /att/cookie/at.php");
    exit;
}


if (isset($_GET['limpar'])) {
    setcookie("usuario_nome", "", time() - 3600, "/");
    setcookie("usuario_idade", "", time() - 3600, "/");
    
    header("Location: /att/cookie/at.php");
    exit;
}


$nome_salvo = isset($_COOKIE['usuario_nome']) ? $_COOKIE['usuario_nome'] : "";
$idade_salva = isset($_COOKIE['usuario_idade']) ? $_COOKIE['usuario_idade'] : "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exemplo de Cookie no PHP - Cadastro</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background-color: #fff; color: #333; }
        .formulario { margin-bottom: 20px; padding: 20px; border: 1px solid #ccc; max-width: 300px; }
        .campo { margin-bottom: 10px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #007BFF; color: white; border: none; cursor: pointer; }
        a { color: #DC3545; text-decoration: none; }
    </style>
</head>
<body>

    
    <?php if ($nome_salvo !== ""): ?>
        
        <h1>Bem-vindo de volta, <?php echo htmlspecialchars($nome_salvo); ?>!</h1>
        <p>Sua idade salva no sistema é de: <?php echo htmlspecialchars($idade_salva); ?> anos.</p>
        <p><a href="/att/cookie/at.php?limpar=1">Esquecer meus dados (Deletar Cookies)</a></p>

    
    <?php else: ?>
        
        <h1>Identifique-se</h1>
        <div class="formulario">
            <form action="/att/cookie/at.php" method="POST">
                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="campo">
                    <label for="idade">Idade:</label>
                    <input type="number" id="idade" name="idade" required>
                </div>
                <button type="submit" name="salvar">Salvar Dados</button>
            </form>
        </div>
        <p>Nenhum dado salvo no momento. Preencha o formulário para testar.</p>

    <?php endif; ?>

</body>
</html>
