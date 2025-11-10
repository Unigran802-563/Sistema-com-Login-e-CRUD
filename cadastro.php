<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    
</head>

<body>
    <h2>Criar Conta</h2>
    <form action="processa_cadastro.php" method="POST">
        <label for="nome">Nome:</label>

        <input type="text" id="nome" name="nome" required>



        <label for="email">Email:</label>

        <input type="email" id="email" name="email" required>



        <label for="senha">Senha:</label>

        <input type="password" id="senha" name="senha" required>



        <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</body>

</html>