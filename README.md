Gerenciador de Informações do Usuário com Cookies no PHP

Este projeto foi desenvolvido para demonstrar o funcionamento prático de cookies no PHP, abordando a teoria e a prática dos conceitos de criação, leitura e expiração de múltiplos dados utilizando um formulário HTML e o método POST.

---

 Conteúdo Complementar em Vídeo

Para  explicações adicionais, assista ao vídeo explicativo pelo link abaixo:
[https://youtube.com](https://www.youtube.com/watch?v=s1y4pvu-VHg)

---

Conceitos Fundamentais

 O que é um Cookie?
Um cookie é um pequeno arquivo de texto que o servidor web solicita ao navegador do usuário para armazenar localmente no computador do cliente. Ele serve para fazer o site lembrar de informações entre um acesso e outro, como preferências de layout, itens no carrinho de compras ou informações de identificação. Os cookies trafegam em todas as requisições HTTP entre o navegador e o servidor.

O que é a função setcookie()?
A função setcookie() é um comando nativo do PHP utilizado para enviar um cookie do servidor para o navegador do usuário. Ela define o nome do arquivo, o conteúdo que será guardado, o tempo de validade e em quais pastas do site ele estará ativo. Essa função precisa ser executada antes de qualquer saída de código HTML ou eco (echo) na tela, pois ela trabalha diretamente com os cabeçalhos HTTP do protocolo.

O que é a superglobal $_COOKIE?
A superglobal $_COOKIE é uma variável nativa do PHP em formato de array associativo. Toda vez que o usuário atualiza ou acessa uma página, o navegador envia automaticamente os cookies salvos daquele site de volta para o servidor. O PHP captura esses dados e os organiza dentro de $_COOKIE, permitindo que o desenvolvedor leia os valores guardados de forma simples.

---

Funcionamento Técnico do Código

O funcionamento do sistema baseia-se na troca de dados estruturados entre o formulário do cliente e as diretivas de armazenamento do servidor web. Abaixo está a explicação detalhada de cada bloco do código:

 1. Criar os Cookies (usuario_nome e usuario_idade)
Quando o usuário preenche o formulário e clica em "Salvar Dados", os valores são enviados ao servidor via método POST.
- Interceptação via $_POST: O PHP valida a existência do envio por meio de isset($_POST['salvar']) e armazena os dados em variáveis locais.
- Múltiplos Cookies: São executadas duas funções setcookie() distintas de forma sequencial para salvar tanto o nome quanto a idade no navegador do cliente de forma independente.
- Definição de Tempo (time() + 3600): Os arquivos expiram em exatamente 1 hora (3600 segundos) a partir do momento da criação.
- Redirecionamento de Segurança: O comando header("Location: /att/cookie/at.php") atualiza a página limpando os dados enviados pelo formulário, permitindo que o navegador carregue e reconheça a presença dos cookies recém-criados.

2. Ler os Cookies e Controle de Interface
A leitura ocorre sempre que a página é acessada ou atualizada.
- Captura e Validação Ternária: O PHP verifica a presença dos registros por meio de isset($_COOKIE['usuario_nome']). Se os dados existirem, eles preenchem as variáveis correspondentes. Caso contrário, elas assumem uma string vazia "".
- Renderização Condicional: No corpo do HTML, um bloco condicional (if/else) altera a tela. Se as variáveis contiverem dados salvos, o formulário é completamente ocultado e uma mensagem personalizada de boas-vindas é exibida. Se estiverem vazias, o formulário de cadastro é mostrado.
- Proteção com htmlspecialchars(): Os valores impressos na tela passam pela função htmlspecialchars() para neutralizar scripts maliciosos (XSS) digitados no formulário.

### 3. Deletar os Cookies (Limpar Dados)
O PHP força a exclusão dos registros no computador do usuário atualizando as chaves criadas.
- Limpeza por Antedata: A função setcookie() é invocada para ambas as chaves com o valor em branco e o tempo de expiração definido no passado (time() - 3600). Ao ler essa instrução, o navegador exclui os arquivos do disco rígido local imediatamente, exibindo novamente o formulário de cadastro após o redirecionamento da página.

 Como Executar o Código

Para rodar este projeto utilizando o ambiente de desenvolvimento Laragon, siga os passos abaixo de forma sequencial:

1. Certifique-se de que a estrutura de pastas do seu projeto está exatamente neste diretório local:
   C:\laragon\www\att\cookie\

2. Verifique se o seu arquivo de código principal está salvo com o nome exato de:
   at.php

3. Abra o painel de controle do Laragon e clique no botão "Start All" para iniciar os serviços do servidor web Apache e do interpretador do PHP.

4. Abra o seu navegador de internet (Chrome, Edge ou Firefox).

5. Digite a URL local correspondente ao seu arquivo na barra de endereços do navegador:
   http://localhost/att/cookie/at.php

6. Preencha o seu nome e sua idade no formulário e clique em "Salvar Dados". A página será recarregada exibindo a mensagem de boas-vindas personalizada. Feche o navegador e abra a página novamente para atestar que os dados permanecem salvos. Clique no link "Esquecer meus dados" para remover o registro.

Código-Fonte Completo (at.php)

```php
<?php
// 1. CRIAR OS COOKIES
if (isset(\$_POST['salvar'])) {
    \$nome_usuario = \$_POST['nome'];
    \$idade_usuario = \$_POST['idade'];
    setcookie("usuario_nome", \$nome_usuario, time() + 3600, "/");
    setcookie("usuario_idade", \$idade_usuario, time() + 3600, "/");
    header("Location: /att/cookie/at.php");
    exit;
}

// 2. RESETAR OS COOKIES
if (isset(\$_GET['limpar'])) {
    setcookie("usuario_nome", "", time() - 3600, "/");
    setcookie("usuario_idade", "", time() - 3600, "/");
    header("Location: /att/cookie/at.php");
    exit;
}

// 3. LER OS COOKIES
\$nome_salvo = isset(\(_COOKIE['usuario_nome']) ?\)_COOKIE['usuario_nome'] : "";
\$idade_salva = isset(\(_COOKIE['usuario_idade']) ?\)_COOKIE['usuario_idade'] : "";
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

    <?php if (\$nome_salvo !== ""): ?>
        <h1>Letra Inicial: Bem-vindo de volta, <?php echo htmlspecialchars(\$nome_salvo); ?>!</h1>
        <p>Sua idade salva no sistema é de: <?php echo htmlspecialchars(\$idade_salva); ?> anos.</p>
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
```
